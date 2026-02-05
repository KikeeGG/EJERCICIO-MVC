<?php
    require_once __DIR__ . '/../Modelos/RepositorioCursos.php';

    class ControladorCursos
    {
        private $repositorio;

        function __construct()
        {
            $this->repositorio = new RepositorioCursos();
        }

        // READ: listar cursos
        function listar()
        {
            try {
                $cursos = $this->repositorio->obtenerTodos();
                $this->renderizar('cursos/listar', ['cursos' => $cursos]);

            } catch (Exception $e) {
                $this->registrarError("LISTAR", $e);
                $this->renderizar('cursos/listar', [
                    'cursos' => [],
                    'error' => 'No se pudieron cargar los cursos. Revisa errores.log'
                ]);
            }
        }

        // Mostrar formulario
        function crear()
        {
            $this->renderizar('cursos/crear', [
                'antiguos' => ['nombre' => '', 'horas' => '']
            ]);
        }

        // CREATE: guardar curso
        function guardar()
        {
            if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
                header("Location: index.php?accion=listar");
                exit;
            }

            $nombre = trim($_POST['nombre'] ?? '');
            $horas = trim($_POST['horas'] ?? '');

            try {
                $this->validar($nombre, $horas);

                $curso = new Curso(
                    null,
                    $nombre,
                    (int)$horas,
                    date('Y-m-d H:i:s')
                );

                $this->repositorio->insertar($curso);

                header("Location: index.php?accion=listar");
                exit;

            } catch (Exception $e) {
                $this->registrarError("GUARDAR", $e);

                $this->renderizar('cursos/crear', [
                    'error' => $e->getMessage(),
                    'antiguos' => ['nombre' => $nombre, 'horas' => $horas]
                ]);
            }
        }

        // Validación
        function validar($nombre, $horas)
        {
            if (strlen($nombre) < 3) {
                throw new Exception("El nombre del curso debe tener al menos 3 caracteres");
            }

            if ($horas === '' || !ctype_digit($horas)) {
                throw new Exception("Las horas deben ser un número entero");
            }

            $horasNum = (int)$horas;
            if ($horasNum < 1 || $horasNum > 1000) {
                throw new Exception("Las horas deben estar entre 1 y 1000");
            }
        }

        // Renderizar: layout + vista
        function renderizar($vista, $datos = [])
        {
            extract($datos);

            $archivoVista = __DIR__ . '/../Vistas/' . $vista . '.php';
            if (!file_exists($archivoVista)) {
                echo "Vista no encontrada: " . $vista;
                return;
            }

            $vistaContenido = $archivoVista;
            require __DIR__ . '/../Vistas/layout.php';
        }

        // Log de errores
        function registrarError($contexto, $e)
        {
            $rutaLog = __DIR__ . '/../../storage/errores.log';
            $fecha = date('Y-m-d H:i:s');

            $linea = $fecha . " | " . $contexto . " | " . $e->getMessage()
                . " | " . $e->getFile() . " | " . $e->getLine() . "\n";

            file_put_contents($rutaLog, $linea, FILE_APPEND);
        }
    }
?>