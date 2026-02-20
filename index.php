<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();

require_once("config.php");
require_once("controller/app.php");
require_once("controller/clientes.php");
require_once("controller/facturas.php");
require_once("controller/lineas.php"); // <-- Añadido controlador de líneas
require_once("controller/recibosControlador.php");


$controlador = '';
if (isset($_GET['c'])):
    $controlador = $_GET['c'];

    $metodo = '';
    if (isset($_GET['m']))
        $metodo = $_GET['m'];

    switch ($controlador):
        case 'clientes':
            if (method_exists('ClientesControlador', $metodo)):
                ClientesControlador::{$metodo}();
            else:
                ClientesControlador::index();
            endif;
            break;

        case 'facturas':
            if (method_exists('FacturasControlador', $metodo)):
                FacturasControlador::{$metodo}();
            else:
                FacturasControlador::index();
            endif;
            break;

        case 'lineas': // <-- Añadido para líneas de factura
            if (method_exists('LineasControlador', $metodo)):
                LineasControlador::{$metodo}();
            else:
                LineasControlador::index();
            endif;
            break;

        case 'recibos':
            if (method_exists('RecibosControlador', $metodo)):
                RecibosControlador::{$metodo}();
            else:
                RecibosControlador::index();
            endif;
            break;


        default:
            AppControlador::index();
    endswitch;

else:
    AppControlador::index();
endif;
