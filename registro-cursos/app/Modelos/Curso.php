<?php
    class Curso{
        public $id;
        public $nombre;
        public $horas;
        public $fechaCreacion;

        function __construct($id, $nombre, $horas, $fechaCreacion){
            $this->id=$id;
            $this->nombre=$nombre;
            $this->horas=$horas;
            $this->fechaCreacion=$fechaCreacion;
        }
    }
?>