<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index()
    {
        $data = [];

        return response()->success($data);
    }

    public function uploadTemplate(Request $request)
    {
        $data = [];
        try {
            $file = $request->file('template');
            if (! $file->isValid()) {
                return response()->json(['success' => false, 'message' => 'Archivo inválido.'], 422);
            }
            // save file to storage/app/templates
            $originalPath = $file->storeAs('templates', 'plantilla_contrato_original.pdf');
            $input = storage_path('app'.$originalPath);

            $outputRealPath = 'app/templates/plantilla_contrato.pdf';
            $output = storage_path($outputRealPath);

            $converted = $this->preprocessPdfForFpdi($input, $output);
        } catch (\Exception $e) {
            logger('Error reading file: '.$e->getMessage());
            $converted = false;
        }

        return response()->success([
            'originalPath' => $originalPath,
            'outputRealPath' => $outputRealPath,
            'converted' => $converted,
        ]);
    }

    private function preprocessPdfForFpdi(string $input, string $output): bool
    {
        $dir = dirname($output);
        if (! is_dir($dir)) {
            @mkdir($dir, 0775, true);
        }
        if (is_file($output)) {
            @unlink($output);
        }

        $esc = static fn ($p) => escapeshellarg($p);

        // Apple Silicon primero (/opt/homebrew), luego Intel (/usr/local)
        $gsBins = ['/opt/homebrew/bin/gs', '/usr/local/bin/gs', 'gs'];
        $qpdfBins = ['/opt/homebrew/bin/qpdf', '/usr/local/bin/qpdf', 'qpdf'];
        $muBins = ['/opt/homebrew/bin/mutool', '/usr/local/bin/mutool', 'mutool'];

        $commands = [];
        foreach ($gsBins as $bin) {
            $commands[] = "$bin -o %OUT% -sDEVICE=pdfwrite -dPDFSETTINGS=/prepress %IN%";
        }
        foreach ($qpdfBins as $bin) {
            $commands[] = "$bin --stream-data=uncompress %IN% %OUT%";
        }
        foreach ($muBins as $bin) {
            $commands[] = "$bin clean -d -a %IN% %OUT%";
        }

        foreach ($commands as $tpl) {
            $cmd = str_replace(['%IN%', '%OUT%'], [$esc($input), $esc($output)], $tpl);
            @exec($cmd.' 2>&1', $out, $code);

            if ($code === 0 && is_file($output) && filesize($output) > 0) {
                return true;
            }
            if (is_file($output) && filesize($output) === 0) {
                @unlink($output);
            }
        }

        return false;
    }
}
