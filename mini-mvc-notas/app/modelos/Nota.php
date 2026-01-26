<?php
    // CLASE NOTA Y SUS DERIVADOS
    class Nota {
        public $id;
        public $texto;
        public $fecha;

        public function __construct($id, $texto, $fecha) {
            $this->id = $id;
            $this->texto = $texto;
            $this->fecha = $fecha;
        }

        public function aLinea() {
            return $this->id . "|" . $this->texto . "|" . $this->fecha;
        }

        public static function desdeLinea($linea) {
            $partes = explode('|', trim($linea));

            if (count($partes) !== 3) {
                throw new Exception("Línea corrupta en notas.txt: $linea");
            }

            return new Nota($partes[0], $partes[1], $partes[2]);
        }
    }