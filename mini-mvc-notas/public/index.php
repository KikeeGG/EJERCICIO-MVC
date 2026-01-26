<?php
    ini_set('display_errors', 1); // CONTROL DE ERRORES
    error_reporting(E_ALL);

    require_once __DIR__ . '/../app/Controladores/ControladorNotas.php'; // REQUIERIMOS CONTROLADOR NOTAS

    $controlador=new ControladorNotas(); // LLAMAMOS A LA FUNCION
    $accion=$_GET['accion'] ?? 'listar';
    // MATCH CASE O EN ESTE CASO SWITCH PARA LISTAR, CREAR Y/O GUARDAR LA NOTA
    switch ($accion) {
        case 'listar':
            $controlador->listar();
            break;

        case 'crear':
            $controlador->crear();
            break;

        case 'guardar':
            $controlador->guardar();
            break;

        default:
            echo "Acción no válida";
    }