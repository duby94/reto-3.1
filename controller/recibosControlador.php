<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

// Modificacion examen para pdf
require_once("model/recibosModelo.php");
require_once("model/facturas.php");    // <-- LO AÑADES AQUÍ
require_once("model/clientes.php");     // <-- Y ESTE
require_once("libs/fpdf/fpdf.php");           // <-- Y ESTE

class RecibosControlador
{
    static function index()
    {
        $recibos = new RecibosModelo();
        $recibos->Seleccionar();
        require_once("view/recibos.php");
    }

    static function Nuevo()
    {
        $opcion = 'NUEVO';
        require_once("view/recibosmantenimiento.php");
    }

    static function Insertar()
    {
        $recibo = new RecibosModelo();

        $recibo->factura_id = isset($_POST['factura_id']) ? intval($_POST['factura_id']) : 0;
        $recibo->fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
        $recibo->importe = isset($_POST['importe']) ? floatval($_POST['importe']) : 0;

        if ($recibo->Insertar() >= 1)
            header("location:" . URLSITE . '?c=recibos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $recibo->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $recibo = new RecibosModelo();
        $recibo->recibo_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $opcion = 'EDITAR';
        if ($recibo->Seleccionar())
            require_once("view/recibosmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $recibo->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $recibo = new RecibosModelo();

        $recibo->recibo_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $recibo->factura_id = isset($_POST['factura_id']) ? intval($_POST['factura_id']) : 0;
        $recibo->fecha = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';
        $recibo->importe = isset($_POST['importe']) ? floatval($_POST['importe']) : 0;

        if (($recibo->Modificar() >= 1) || ($recibo->GetError() == ''))
            header("location:" . URLSITE . '?c=recibos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $recibo->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $recibo = new RecibosModelo();
        $recibo->recibo_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($recibo->Borrar() >= 1)
            header("location:" . URLSITE . '?c=recibos');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $recibo->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    // Metodo añadido para Examen
    static function recibos()
    {
        $factura_id = isset($_GET['factura_id']) ? intval($_GET['factura_id']) : 0;

        if ($factura_id <= 0) {
            echo "Factura no válida";
            return;
        }

        // Obtener la factura
        $factura = new FacturasModelo();
        $factura->id = $factura_id;
        if (!$factura->Seleccionar()) {
            echo "Factura no encontrada";
            return;
        }

        // Obtener el cliente
        $cliente = new ClientesModelo();
        $cliente->id = $factura->cliente_id;
        if (!$cliente->Seleccionar()) {
            echo "Cliente no encontrado";
            return;
        }

        // Calcular fechas según forma de pago
        $dias = [0]; // por defecto contado
        switch ($cliente->formadepago) {
            case 2:
                $dias = [30];
                break;
            case 3:
                $dias = [30, 60];
                break;
        }

        // Insertar recibos
        $recibo = new RecibosModelo();
        foreach ($dias as $d) {
            $recibo->factura_id = $factura->id;
            $recibo->fecha = date('Y-m-d', strtotime($factura->fecha . " +$d days"));
            $recibo->importe = $factura->importe; // asumir que la factura tiene el importe total
            $recibo->Insertar();
        }

        // Redirigir a la lista de recibos
        header("Location: index.php?c=recibos&m=index");
    }


    // Modificacion para examen para generar pdf
    static function imprimir()
    {
        $recibo_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($recibo_id <= 0) {
            echo "Recibo no válido";
            return;
        }

        require_once("libs/fpdf/fpdf.php");

        $recibo = new RecibosModelo();
        $recibo->recibo_id = $recibo_id;
        if (!$recibo->Seleccionar()) {
            echo "Recibo no encontrado";
            return;
        }

        $factura = new FacturasModelo();
        $factura->id = $recibo->factura_id;
        $factura->Seleccionar();

        $cliente = new ClientesModelo();
        $cliente->id = $factura->cliente_id;
        $cliente->Seleccionar();

        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(0, 10, "Recibo", 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(50, 10, "Cliente:", 0, 0);
        $pdf->Cell(0, 10, $cliente->nombre . ' ' . $cliente->apellidos, 0, 1);

        $pdf->Cell(50, 10, "Número de factura:", 0, 0);
        $pdf->Cell(0, 10, $factura->numero, 0, 1);

        $pdf->Cell(50, 10, "Fecha de factura:", 0, 0);
        $pdf->Cell(0, 10, $factura->fecha, 0, 1);

        $pdf->Cell(50, 10, "Fecha de recibo:", 0, 0);
        $pdf->Cell(0, 10, $recibo->fecha, 0, 1);

        $pdf->Cell(50, 10, "Importe:", 0, 0);
        $pdf->Cell(0, 10, number_format($recibo->importe, 2), 0, 1);

        $pdf->Output();
    }

}
