<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("model/clientes.php");

class ClientesControlador
{
    static function index()
    {
        $clientes = new ClientesModelo();
        $clientes->Seleccionar();
        require_once("view/clientes.php");
    }

    static function Nuevo()
    {
        $opcion = 'NUEVO';
        require_once("view/clientesmantenimiento.php");
    }

    static function Insertar()
    {
        $cliente = new ClientesModelo();

        $cliente->nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $cliente->apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
        $cliente->email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $cliente->contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';
        $cliente->direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
        $cliente->cp = isset($_POST['cp']) ? trim($_POST['cp']) : '';
        $cliente->poblacion = isset($_POST['poblacion']) ? trim($_POST['poblacion']) : '';
        $cliente->provincia = isset($_POST['provincia']) ? trim($_POST['provincia']) : '';
        $cliente->fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : '';
        // Modificacion examen
        $cliente->formadepago = isset($_POST['formadepago']) ? intval($_POST['formadepago']) : 1;


        if ($cliente->Insertar() >= 1)
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }


    static function Editar()
    {
        $cliente = new ClientesModelo();

        $cliente->id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        $opcion = 'EDITAR';
        if ($cliente->Seleccionar())
            require_once("view/clientesmantenimiento.php");
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    static function Modificar()
    {
        $cliente = new ClientesModelo();

        $cliente->id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        $cliente->nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $cliente->apellidos = isset($_POST['apellidos']) ? trim($_POST['apellidos']) : '';
        $cliente->email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $cliente->contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : '';
        $cliente->direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
        $cliente->cp = isset($_POST['cp']) ? trim($_POST['cp']) : '';
        $cliente->poblacion = isset($_POST['poblacion']) ? trim($_POST['poblacion']) : '';
        $cliente->provincia = isset($_POST['provincia']) ? trim($_POST['provincia']) : '';
        $cliente->fecha_nacimiento = isset($_POST['fecha_nacimiento']) ? trim($_POST['fecha_nacimiento']) : '';
        // Modificacion examen
        $cliente->formadepago = isset($_POST['formadepago']) ? intval($_POST['formadepago']) : 1;

        if (($cliente->Modificar() >= 1) || ($cliente->GetError() == ''))
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }


    static function Borrar()
    {
        $cliente = new ClientesModelo();

        $cliente->id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        if ($cliente->Borrar() >= 1)
            header("location:" . URLSITE . '?c=clientes');
        else {
            $_SESSION["CRUDMVC_ERROR"] = $cliente->GetError();
            header("location:" . URLSITE . "view/error.php");
        }
    }

    // Puedes añadir más métodos (p. ej. facturas) aquí
}
