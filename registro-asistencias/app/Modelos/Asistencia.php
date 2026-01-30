<?php
// CLASE ASISTENCIA Y SU CONSTRUCTOR + FUNCIÓN esValida
    class Asistencia{
        public $id;
        public $nombreAlumno;
        public $fecha;
        public $asiste;

        public function __construct($id, $nombreAlumno, $fecha, $asiste){
            $this->id=$id;
            $this->nombreAlumno=$nombreAlumno;
            $this->fecha=$fecha;
            $this->asiste=$asiste;
        }
        public function esValida(){ // VALIDAR DATOS
            if (empty($this->nombreAlumno)) return false;
            if (strlen($this->nombreAlumno) <3 || strlen($this->nombreAlumno) >40) return false;
            if (!in_array($this->asiste,['SI', 'NO'])) return false;
            return true;
        }
    }
?>