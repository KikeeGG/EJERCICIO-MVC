<?php
// app/Modelos/RepositorioContactos.php

require_once __DIR__ . '/Contacto.php';

class RepositorioContactos
{
    public $rutaArchivo;

    function __construct()
    {
        $this->rutaArchivo = __DIR__ . '/../../storage/agenda.txt';
    }

    // Devuelve todos los contactos
    function obtenerTodos()
    {
        if (!file_exists($this->rutaArchivo)) {
            return [];
        }

        $lineas = file($this->rutaArchivo, FILE_IGNORE_NEW_LINES);
        $contactos = [];

        foreach ($lineas as $linea) {
            if (trim($linea) === '') {
                continue;
            }

            // Puede lanzar excepción si la línea está mal
            $contactos[] = Contacto::desdeLinea($linea);
        }

        return $contactos;
    }

    // Agrega un contacto al final del fichero
    function agregar($contacto)
    {
        $linea = $contacto->aLinea() . "\n";
        $resultado = file_put_contents($this->rutaArchivo, $linea, FILE_APPEND);

        if ($resultado === false) {
            throw new Exception("No se pudo escribir en agenda.txt (revisa permisos o ruta)");
        }
    }

    // Borra un contacto por ID reescribiendo el fichero
    function borrarPorId($id)
    {
        if (!file_exists($this->rutaArchivo)) {
            return;
        }

        $lineas = file($this->rutaArchivo, FILE_IGNORE_NEW_LINES);
        $nuevasLineas = [];

        foreach ($lineas as $linea) {
            if (trim($linea) === '') {
                continue;
            }

            $partes = explode('|', $linea);

            // Si es el id que queremos borrar, lo saltamos
            if (isset($partes[0]) && $partes[0] == $id) {
                continue;
            }

            $nuevasLineas[] = $linea;
        }

        $resultado = file_put_contents($this->rutaArchivo, implode("\n", $nuevasLineas) . "\n");

        if ($resultado === false) {
            throw new Exception("No se pudo reescribir agenda.txt al borrar");
        }
    }
}