<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    {{-- https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid">
        {{-- Cotización center --}}
        <div class="row">
            <div class="col-12">
                <h4 class="text-center">COTIZACIÓN</h4>
            </div>
        </div>
        {{-- Datos de la boda en 2 columnas Formulario y Logo --}}
        <div class="row">
            <div class="col-6">
                <p>Fecha: </p>
                <p>Teléfono: </p>
                <p>Nombre: </p>
                <p>Domicilio: </p>
                <p>Lugar del evento: </p>
                <p>Fecha y hora del evento: </p>
                <p>Tipo de evento: </p>
            </div>
            <div class="col-6">
                {{-- <img src="{{ asset('img/logo.png') }}" alt="Logo" class="img-fluid"> --}}
            </div>
        </div>
        {{-- Tabla de productos --}}
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th colspan="4">Paquete: Papel picado</th>
                        </tr>
                        <tr>
                            <th>Descripción</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="3">
                                Producto 1 <br>
                                Producto 2 Producto 2 Producto 2 Producto 2 Producto 2 <br>
                                Producto 3
                            </td>
                            <td>1</td>
                            <td>$100.00</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>$200.00</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>$200.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-end">Subtotal</td>
                            <td>$500.00</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">IVA</td>
                            <td>$80.00</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-end">Total</td>
                            <td>$580.00</td>
                        </tr>
                </table>
            </div>
        </div>

        {{-- Terminos y condiciones del evento --}}
        <div class="row">
            <div class="col-12">
                <p>
                    *** PRECIOS SUJETOS A CAMBIOS SIN PREVIO AVISO ***<br>
                    ***LOS PRECIOS NO INCLUYEN IVA***<br>
                    *** LA PRESENTE COTIZACIÓN TIENE UNA VIGENCIA DE 30 DIAS****<br>
                    *LA PRESENTE COTIZACIÓN SIRVE COMO RECIBO DEL ANTICIPO DEL 30% UNA VEZ QUE SE FIRME DE ACEPTADO POR
                    PARTE DEL CLIENTE, CON
                    EL COMPROMISO DE PAGAR EL SALDO EL DIA DEL EVENTO ANTES DE LAS 2:00PM*<br>
                    * LOS VIÁTICOS DEBERAN SER PAGADOS POR ANTICIPADO<br>
                    * EL EVENTO SE DARA COMO EFECTUADO, SI POR CAUSAS DE FUERZA MAYOR O FUERA DE NUESTRO CONTROL, ESTE
                    SEA SUSPENDIDO, COMO
                    PUEDEN SER: LLUVIA, FALTA DE CONDICIONES MÍNIMAS DE SEGURIDAD, NO AUTORIZACION DE QUEMA POR LOS
                    ENCARGADOS DEL LOCAL,
                    CANCELACION DEL EVENTO SIN PREVIO AVISO CON 48 HRS.<br>
                    *EL EVENTO DEBE SER REALIZADO DENTRO DE LA HORA ESTABLECIDA EN EL CONTRATO, DE LO CONTRARIO SE
                    COBRARÁ POR EL TIEMPO EXTRA
                    DE ESPERA, $300.00 POR CADA HORA TRANSCURRIDA**
                </p>
            </div>
        </div>
    </div>
    {{-- https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
