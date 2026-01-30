<?php
// app/Modelos/Contacto.php

class Contacto
{
    public $id;
    public $nombre;
    public $telefono;
    public $email;
    public $notas;
    public $fechaCreacion;

    function __construct($id, $nombre, $telefono, $email, $notas, $fechaCreacion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->notas = $notas;
        $this->fechaCreacion = $fechaCreacion;
    }

    // Convierte el contacto a una línea para guardarla en el fichero
    function aLinea()
    {
        // Para evitar romper el formato si el usuario mete el símbolo "|"
        $nombreSeguro = str_replace('|', '/', $this->nombre);
        $emailSeguro = str_replace('|', '/', $this->email);
        $notasSeguro = str_replace('|', '/', $this->notas);

        return $this->id . "|" . $nombreSeguro . "|" . $this->telefono . "|" . $emailSeguro . "|" . $notasSeguro . "|" . $this->fechaCreacion;
    }

    // static: crear un Contacto desde una línea del fichero
    static function desdeLinea($linea)
    {
        $partes = explode('|', trim($linea));

        if (count($partes) !== 6) {
            throw new Exception("Línea corrupta en agenda.txt: " . $linea);
        }

        return new Contacto($partes[0], $partes[1], $partes[2], $partes[3], $partes[4], $partes[5]);
    }
}
