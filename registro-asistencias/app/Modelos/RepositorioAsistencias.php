<?php
    require_once __DIR__.'/Asistencia.php';

    class RepositorioAsistencias{
        // Propiedades privadas que almacenan las rutas de los archivos.
        private $rutaFichero;
        private $rutaErrores;
        // LEE Y ESCRIBE EL .TXT
        public function __construct(){
            $this->rutaFichero= __DIR__ .'/../../storage/asistencias.txt';
            $this->rutaErrores= __DIR__ .'/../../storage/errores.log';
        }
        public function guardar(Asistencia $a){ // Método para guardar una nueva asistencia en el archivo de texto.
            $linea="{$a->id}|{$a->nombreAlumno}|{$a->fecha}|{$a->asiste}\n";
            file_put_contents($this->rutaFichero, $linea, FILE_APPEND);
        }
        public function obtenerTodas(){ // Método que obtiene todas las asistencias almacenadas en el archivo.
            $asistencias=[];
            if (!file_exists($this->rutaFichero)) return $asistencias;

            $lineas=file($this->rutaFichero,FILE_IGNORE_NEW_LINES);
            foreach ($lineas as $numLinea => $linea){
                $partes=explode('|', $linea);
                if (count($partes) !== 4){ // Si no hay exactamente 4 partes, la línea está corrupta
                    $this->logError("Línea corrupta $numLinea: linea");
                    $asistencias[]=null;
                    continue;
                }

                [$id, $nombre, $fecha, $asiste] = $partes;

                if (!in_array($asiste, ['SI', 'NO'])){
                    $this->logError("Valor NO inválido en línea $numLinea");
                    $asistencias[]=null;
                    continue;
                }
                $asistencias[]=new Asistencia($id, $nombre, $fecha, $asiste);
            }
            return $asistencias; // Devuelve el array con todas las asistencias procesadas.
        }

        private function logError($mensaje){ // GESTION DE ERRORES
            $fecha=date('Y-m-d H:i:s');
            file_put_contents($this->rutaErrores,"[$fecha] $mensaje\n",FILE_APPEND);
        }
    }
?>