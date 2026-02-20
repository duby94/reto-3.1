<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once("model/facturas.php");

class FacturasControlador
{
    static function index()
    {
        $facturas = new FacturasModelo();
        $facturas->Seleccionar();
        require_once("view/facturas.php");
    }

    static function Nuevo()
    {
        $opcion = 'NUEVO';
        require_once("view/facturasmantenimiento.php");
    }

    static function Insertar()
    {
        $factura = new FacturasModelo();

        $factura->cliente_id = isset($_POST['cliente_id']) ? intval($_POST['cliente_id']) : 0;
        $factura->numero     = isset($_POST['numero']) ? intval($_POST['numero']) : 0;
        $factura->fecha      = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';

        if ($factura->Insertar() >= 1)
            header("location:" . URLSITE . '?c=facturas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $factura = new FacturasModelo();
        $factura->id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $opcion = 'EDITAR';
        if ($factura->Seleccionar())
            require_once("view/facturasmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $factura = new FacturasModelo();

        $factura->id         = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $factura->cliente_id = isset($_POST['cliente_id']) ? intval($_POST['cliente_id']) : 0;
        $factura->numero     = isset($_POST['numero']) ? intval($_POST['numero']) : 0;
        $factura->fecha      = isset($_POST['fecha']) ? trim($_POST['fecha']) : '';

        if (($factura->Modificar() >= 1) || ($factura->GetError() == ''))
            header("location:" . URLSITE . '?c=facturas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $factura = new FacturasModelo();
        $factura->id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($factura->Borrar() >= 1)
            header("location:" . URLSITE . '?c=facturas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $factura->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
