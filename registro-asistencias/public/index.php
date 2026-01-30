<?php
    require_once __DIR__ . '/../app/Controladores/ControladorAsistencias.php';
    // DECIDE LA ACCIÓN Y LLAMA AL CONTROLADOR
    $accion=$_GET['accion'] ?? 'listar';
    $controlador=new ControladorAsistencias();
    switch ($accion){
        case 'crear':
            $controlador->crear();
            break;
        case 'guardar':
            $controlador->guardar();
            break;
        default:
            $controlador->listar();
    }
?>