<?php
// public/index.php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Incluimos el controlador principal
require_once __DIR__ . '/../app/Controladores/ControladorContactos.php';

// Creamos el controlador
$controlador = new ControladorContactos();

// Leemos la acción (por defecto: listar)
$accion = $_GET['accion'] ?? 'listar';

// Ejecutamos la acción correspondiente
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

    case 'borrar':
        $controlador->borrar();
        break;

    default:
        echo "Acción no válida";
}