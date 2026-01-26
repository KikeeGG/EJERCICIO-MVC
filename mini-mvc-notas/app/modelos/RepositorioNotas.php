<?php
    require_once __DIR__ . '/Nota.php';
    // FUNCION PRINCIPAL SERA METER NOTAS EN EL NOTAS.TXT
    class RepositorioNotas {

        private $rutaArchivo;

        public function __construct() {
            $this->rutaArchivo = __DIR__ . '/../../storage/notas.txt';
        }

        public function obtenerTodas() {
            if (!file_exists($this->rutaArchivo)) {
                return [];
            }

            $lineas = file($this->rutaArchivo);
            $notas = [];

            foreach ($lineas as $linea) {
                if (trim($linea) === '') continue;
                $notas[] = Nota::desdeLinea($linea);
            }

            return $notas;
        }

        public function agregar(Nota $nota) {
            $linea = $nota->aLinea() . "\n";
            $resultado = file_put_contents($this->rutaArchivo, $linea, FILE_APPEND);

            if ($resultado === false) {
                throw new Exception("No se pudo escribir en notas.txt");
            }
        }
    }