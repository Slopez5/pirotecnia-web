<?php

namespace App\Helper;

use setasign\Fpdi\Fpdi;

class PdfQuoteFiller
{
    /**
     * Rellena la plantilla con los datos y devuelve el binario PDF.
     * $data = [
     *   'fecha' => '2025-08-31',
     *   'telefono' => '312-123-4567',
     *   'nombre' => 'Nombre del Cliente',
     *   'domicilio' => 'Domicilio del Cliente',
     *   'lugar_evento' => 'Salón X',
     *   'fecha_hora_evento' => '2025-09-15 20:00',
     *   'tipo_evento' => 'Boda',
     *   'anticipo' => 3000.00,
     *   'saldo' => 7000.00,
     *   'paquete' => 'Paquete Oro',
     *   'items' => [
     *       ['descripcion'=>'Show pirotécnico 8 min', 'cantidad'=>1, 'precio'=>8000],
     *       ['descripcion'=>'Efectos fríos (sparklers)', 'cantidad'=>4, 'precio'=>250],
     *   ],
     *   'viaticos' => 500.00,
     * ];
     */
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
        $write(41, 26, $data['fecha'] ?? '');
        $write(48, 33, $data['telefono'] ?? '');
        $write(44, 39, $data['nombre'] ?? '');
        $write(47, 46, $data['domicilio'] ?? '');

        // Datos de evento
        $write(66, 53, $data['lugar_evento'] ?? '');
        $write(81, 59, $data['fecha_hora_evento'] ?? '');
        $write(54, 65.5, $data['tipo_evento'] ?? '');

        // Paquete
        $write(40, 71, $data['paquete'] ?? '', 12, false);

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
        $items = $data['items'] ?? [];
        $lineHeight = 7;

        foreach ($items as $item) {

            $desc = (string) ($item['descripcion'] ?? '');
            $desc = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $desc);
            $cant = (string) ($item['cantidad'] ?? '');
            $prec = $this->money($item['precio'] ?? 0);

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
            $pdf->Cell($wPrec, $rowHeight, $prec, 0, 0, 'R');

            $y += $rowHeight; // siguiente renglón
        }

        // Viáticos y total
        $subtotal = array_reduce($items, fn ($c, $i) => $c + ((float) $i['precio'] * (float) ($i['cantidad'] ?? 1)), 0.0);
        $viaticos = (float) ($data['viaticos'] ?? 0);
        $total = $subtotal + $viaticos;

        // // Viáticos (alineado al layout de tu plantilla)
        $write(163, 122, $this->money($viaticos));
        // // Total
        $write(163, 126.5, $this->money($total), 12, true);

        // Anticipo / Saldo
        $write(55, 175, $this->money($data['anticipo'] ?? 0));

        $saldo = $total - (float) ($data['anticipo'] ?? 0);
        $write(140, 175, $this->money($saldo));

        return $pdf->Output('S'); // 'S' = return as string
    }

    private function money(float $v): string
    {
        return ''.number_format($v, 2, '.', ',');
    }
}
