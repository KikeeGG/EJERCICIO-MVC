<?php
    require_once __DIR__ . '/../Modelos/RepositorioNotas.php';
    // EL GROSO CON ERRORES POSIBLES CONTROLADOS
    class ControladorNotas {

        private $repositorio;

        public function __construct() {
            $this->repositorio = new RepositorioNotas();
        }

        private function renderizar($vista, $datos = []) {
            extract($datos);
            $vistaContenido = __DIR__ . '/../Vistas/' . $vista . '.php';
            require __DIR__ . '/../Vistas/layout.php';
        }

        private function registrarError($contexto, Exception $e) {
            $archivoLog = __DIR__ . '/../../storage/errores.log';
            $fecha = date('Y-m-d H:i:s');
            $linea = "$fecha | $contexto | {$e->getMessage()}\n";
            file_put_contents($archivoLog, $linea, FILE_APPEND);
        }

        public function listar() {
            try {
                $notas = $this->repositorio->obtenerTodas();
                $this->renderizar('notas/listar', ['notas' => $notas]);
            } catch (Exception $e) {
                $this->registrarError('LISTAR', $e);
                $this->renderizar('notas/listar', [
                    'notas' => [],
                    'error' => 'No se pudieron cargar las notas'
                ]);
            }
        }

        public function crear() {
            $this->renderizar('notas/crear', [
                'antiguos' => ['texto' => '']
            ]);
        }

        public function guardar() {
            try {
                $texto = trim($_POST['texto'] ?? '');

                if (strlen($texto) < 3) {
                    throw new Exception("La nota debe tener al menos 3 caracteres");
                }
                if (strlen($texto) > 80) {
                    throw new Exception("La nota no puede superar 80 caracteres");
                }

                $nota = new Nota(time(), $texto, date('Y-m-d H:i'));
                $this->repositorio->agregar($nota);

                header("Location: index.php?accion=listar");
                exit;

            } catch (Exception $e) {
                $this->registrarError('GUARDAR', $e);
                $this->renderizar('notas/crear', [
                    'error' => $e->getMessage(),
                    'antiguos' => ['texto' => $texto]
                ]);
            }
        }
    }