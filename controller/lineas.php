<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once("model/lineas.php");

class LineasControlador
{
    static function index()
    {
        $lineas = new LineasModelo();
        $lineas->Seleccionar();
        require_once("view/lineas.php");
    }

    static function Nuevo()
    {
        $opcion = 'NUEVO';
        require_once("view/lineasmantenimiento.php");
    }

    static function Insertar()
    {
        $linea = new LineasModelo();
        $linea->factura_id = isset($_POST['factura_id']) ? intval($_POST['factura_id']) : 0;
        $linea->referencia = isset($_POST['referencia']) ? trim($_POST['referencia']) : '';
        $linea->descripcion= isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
        $linea->cantidad   = isset($_POST['cantidad']) ? floatval($_POST['cantidad']) : 0;
        $linea->precio     = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
        $linea->iva        = isset($_POST['iva']) ? floatval($_POST['iva']) : 0;

        if ($linea->Insertar() >= 1)
            header("location:" . URLSITE . '?c=lineas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Editar()
    {
        $linea = new LineasModelo();
        $linea->id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $opcion = 'EDITAR';
        if ($linea->Seleccionar())
            require_once("view/lineasmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $linea = new LineasModelo();
        $linea->id         = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $linea->factura_id = isset($_POST['factura_id']) ? intval($_POST['factura_id']) : 0;
        $linea->referencia = isset($_POST['referencia']) ? trim($_POST['referencia']) : '';
        $linea->descripcion= isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
        $linea->cantidad   = isset($_POST['cantidad']) ? floatval($_POST['cantidad']) : 0;
        $linea->precio     = isset($_POST['precio']) ? floatval($_POST['precio']) : 0;
        $linea->iva        = isset($_POST['iva']) ? floatval($_POST['iva']) : 0;

        if (($linea->Modificar() >= 1) || ($linea->GetError() == ''))
            header("location:" . URLSITE . '?c=lineas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Borrar()
    {
        $linea = new LineasModelo();
        $linea->id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($linea->Borrar() >= 1)
            header("location:" . URLSITE . '?c=lineas');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $linea->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }
}
