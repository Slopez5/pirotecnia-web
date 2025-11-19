<?php

namespace App\Helper;

use setasign\Fpdi\Fpdi;

class PdfQuoteFiller
{
    public function fill(array $data): string
    {
        $templatePath = storage_path('app/templates/plantilla_contrato_original.pdf');

        $pdf = new Fpdi('P', 'mm'); // milímetros
        $pdf->AddPage();
        $pdf->setSourceFile($templatePath);
        $tpl = $pdf->importPage(1);
        $pdf->useTemplate($tpl, 0, 0, 210); // A4 ancho 210mm

        // Fuente
        $pdf->SetFont('Arial', '', 11);

        // Helper para texto
        $write = function (float $x, float $y, string $txt, int $size = 11, bool $bold = false) use ($pdf) {
            $pdf->SetFont('Arial', $bold ? 'B' : '', $size);
            $pdf->SetXY($x, $y);
            $pdf->Cell(0, 6, $txt, 0, 0, 'L');
        };

        // ⚠️ Coordenadas de ejemplo (ajústalas una sola vez a tu plantilla)
        // Encabezado (fecha, teléfono, nombre, domicilio…)
        $discount = 0;
        $date = (string) ($data['fecha'] ?? '');
        $date = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $date);
        $phone = (string) ($data['telefono'] ?? '');
        $phone = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $phone);
        $name = (string) ($data['nombre'] ?? '');
        $name = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $name);
        $address = (string) ($data['domicilio'] ?? '');
        $address = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $address);
        $event_place = (string) ($data['lugar_evento'] ?? '');
        $event_place = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $event_place);
        $event_datetime = (string) ($data['fecha_hora_evento'] ?? '');
        $event_datetime = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $event_datetime);
        $event_type = (string) ($data['tipo_evento'] ?? '');
        $event_type = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $event_type);
        $package = (string) ($data['paquete'] ?? '');
        $package = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $package);

        $write(41, 26, $date ?? '');
        $write(48, 33, $phone ?? '');
        $write(44, 39, $name ?? '');
        $write(47, 46, $address ?? '');

        // Datos de evento
        $write(66, 53, $event_place ?? '');
        $write(81, 59, $event_datetime ?? '');
        $write(54, 65.5, $event_type ?? '');

        // Paquete
        $write(40, 71, $package ?? '', 12, false);

        // Tabla: Descripción | Cantidad | Precio
        // Coordenadas base de la tabla (ajústalas a tu diseño)
        $y = 84;              // primera fila
        $xDesc = 23;
        $wDesc = 120;
        $xCant = 135;
        $wCant = 20;
        $xPrec = 155;
        $wPrec = 25;

        $pdf->SetFont('Arial', '', 11);
        $items = $data['packages']->toArray() ?? [];
        $lineHeight = 7;

        foreach ($items as $item) {
            $desc = (string) ($item->name ?? '');
            $desc = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $desc);
            $cant = '1';
            $prec = $this->money($item->price ?? 0);

            //     // Descripción con MultiCell para cortes de línea
            $pdf->SetXY($xDesc, $y);
            $pdf->MultiCell($wDesc, $lineHeight, $desc, 0, 'L');

            $usedHeight = $pdf->GetY() - $y;
            $rowHeight = max($lineHeight, $usedHeight);

            //     // Cantidad
            $pdf->SetXY($xCant, $y);
            $pdf->Cell($wCant, $rowHeight, $cant, 0, 0, 'C');

            //     // Precio
            $pdf->SetXY($xPrec, $y);
            if ($item->price <= 0) {
                $prec = '';
            }
            $pdf->Cell($wPrec, $rowHeight, $prec, 0, 0, 'R');

            $y += $rowHeight; // siguiente renglón
        }
        if (key_exists('discount',$data)) {
            if ($data['discount'] > 0) {
                // Descuento
                $pdf->SetXY($xDesc, $y);
                $pdf->MultiCell($wDesc, $lineHeight, 'Descuento', 0, 'L');

                $usedHeight = $pdf->GetY() - $y;
                $rowHeight = max($lineHeight, $usedHeight);

                // Cantidad (vacía)
                $pdf->SetXY($xCant, $y);
                $pdf->Cell($wCant, $lineHeight, '', 0, 0, 'C');

                // Precio del descuento
                $pdf->SetXY($xPrec, $y);
                $discount = (float) ($data['discount'] ?? 0);
                // Validate % or $
                if ($discount > 0 && $discount < 1) {
                    $discount = $discount * ($data['saldo'] ?? 0);
                }
                $pdf->Cell($wPrec, $lineHeight, '-'.$this->money($discount), 0, 0, 'R');

                $y += $rowHeight; // siguiente renglón
            }
        }
        
        // Viáticos y total

        $viaticos = (float) ($data['viaticos'] ?? 0);
        $total = $data['total'] > 0 ? $data['total'] : $data['saldo'] ?? 0;

        // // Viáticos (alineado al layout de tu plantilla)
        $write(163, 122, $this->money($viaticos));
        // // Total
        $write(163, 126.5, $this->money($total), 12, true);

        // Anticipo / Saldo
        $write(55, 175, $this->money($data['anticipo'] ?? 0));

        if ($data['total'] > 0) {
            $saldo = $data['total'] - ($data['anticipo'] ?? 0);
        } else {
            $saldo = ($data['saldo'] ?? 0) - ($data['anticipo'] ?? 0);
        }

        $write(140, 175, $this->money($saldo));

        return $pdf->Output('S'); // 'S' = return as string
    }

    private function money(float $v): string
    {
        return ''.number_format($v, 2, '.', ',');
    }
}
