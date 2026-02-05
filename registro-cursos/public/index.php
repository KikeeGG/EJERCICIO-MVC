<?php
    // CARGAR CONTROLADOR, LEER ACCION, EJECUTAR METODO
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    require_once __DIR__.'/../app/Controladores/ControladorCursos.php';
    $controlador=new ControladorCursos();
    $accion= $_GET['accion'] ?? 'listar';
    
    switch ($accion){
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
            echo"Accion no válida";
    }
?>