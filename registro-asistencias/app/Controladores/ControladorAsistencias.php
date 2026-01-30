<?php
    require_once __DIR__ . '/../Modelos/RepositorioAsistencias.php';
    // PARA CONECTAR MLA PARTE DE MODELOS CON LA DE VISTAS
    class ControladorAsistencias{
        private $repo;

        public function __construct(){
            $this->repo=new RepositorioAsistencias();
        }

        public function listar(){ // Método que muestra la lista de asistencias
            $asistencias=$this->repo->obtenerTodas();
            $vista= __DIR__ .'/../Vistas/asistencias/listar.php';
            require __DIR__ .'/../Vistas/layout.php';
        }

        public function crear(){ // Método que muestra el formulario para crear una asistencia
            $vista= __DIR__ .'/../Vistas/asistencias/crear.php';
            require __DIR__ .'/../Vistas/layout.php';
        }

        public function guardar(){ // Método que procesa el formulario y guarda la asistencia
            $nombre=trim($_POST['nombreAlumno'] ?? '');
            $asiste=$_POST['asiste'] ?? '';
            $fecha=date('Y-m-d');
            $id=uniqid();
            $asistencia = new Asistencia($id, $nombre, $fecha, $asiste);
            if ($asistencia->esValida()){
                $this->repo->guardar($asistencia);
            }

            header('Location: index.php?accion=listar');
            exit;
        }
    }
?>