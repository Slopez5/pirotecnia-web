<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\Printer;

class TicketController extends Controller
{
    //

    public function printReceipt(Request $request)
    {
        // Validar que se haya enviado el texto para imprimir
        $request->validate([
            'text' => 'required|string',
        ]);

        // Obtener el texto del recibo desde la solicitud
        $text = $request->input('text');

        try {
            // Configuración de la impresora
            //$connector = new NetworkPrintConnector("host.docker.internal", 9100); // Cambia la IP y el puerto según sea necesario
            $connector = new CupsPrintConnector("Xprinter_USB_Printer_P");
            $printer = new Printer($connector);

            // Imprimir el recibo
            $printer->text("----Ticket----\n");
            $printer->text($text . "\n");
            $printer->cut();
            $printer->close();

            return response()->json(['success' => true, 'message' => 'Recibo impreso correctamente.']);
        } catch (\Exception $e) {
            // Manejar errores de impresión
            return response()->json(['success' => false, 'message' => 'Error al imprimir el recibo: ' . $e->getMessage()], 500);
        }
            
    }

}
