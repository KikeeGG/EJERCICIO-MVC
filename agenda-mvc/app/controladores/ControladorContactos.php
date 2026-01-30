<?php
// app/Controladores/ControladorContactos.php

require_once __DIR__ . '/../Modelos/RepositorioContactos.php';

class ControladorContactos
{
    public $repositorio;

    function __construct()
    {
        $this->repositorio = new RepositorioContactos();
    }

    // LISTAR
    function listar()
    {
        try {
            $contactos = $this->repositorio->obtenerTodos();
            $this->renderizar('contactos/listar', ['contactos' => $contactos]);
        } catch (Exception $e) {
            $this->registrarError("LISTAR", $e);
            $this->renderizar('contactos/listar', [
                'contactos' => [],
                'error' => 'No se pudo cargar la agenda. Revisa errores.log'
            ]);
        }
    }

    // MOSTRAR FORMULARIO
    function crear()
    {
        $this->renderizar('contactos/crear', [
            'antiguos' => ['nombre'=>'', 'telefono'=>'', 'email'=>'', 'notas'=>'']
        ]);
    }

    // GUARDAR CONTACTO (POST)
    function guardar()
    {
        // Si no es POST, volvemos a listar
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header("Location: index.php?accion=listar");
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');
        $telefono = trim($_POST['telefono'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $notas = trim($_POST['notas'] ?? '');

        try {
            $this->validar($nombre, $telefono, $email, $notas);

            $id = (string) time();
            $fechaCreacion = date('Y-m-d H:i:s');

            $contacto = new Contacto($id, $nombre, $telefono, $email, $notas, $fechaCreacion);

            $this->repositorio->agregar($contacto);

            header("Location: index.php?accion=listar");
            exit;

        } catch (Exception $e) {
            $this->registrarError("GUARDAR", $e);

            // Volvemos al formulario, conservando lo que escribió el usuario
            $this->renderizar('contactos/crear', [
                'error' => $e->getMessage(),
                'antiguos' => [
                    'nombre' => $nombre,
                    'telefono' => $telefono,
                    'email' => $email,
                    'notas' => $notas
                ]
            ]);
        }
    }

    // BORRAR CONTACTO
    function borrar()
    {
        $id = $_GET['id'] ?? '';

        try {
            if ($id === '') {
                throw new Exception("Falta el id para borrar");
            }

            $this->repositorio->borrarPorId($id);

        } catch (Exception $e) {
            $this->registrarError("BORRAR", $e);
        }

        header("Location: index.php?accion=listar");
        exit;
    }

    // VALIDACIÓN (reglas de negocio)
    function validar($nombre, $telefono, $email, $notas)
    {
        if (strlen($nombre) < 3) {
            throw new Exception("El nombre debe tener al menos 3 caracteres");
        }

        // Teléfono numérico + longitud 9 o 10
        if (!ctype_digit($telefono) || (strlen($telefono) !== 9 && strlen($telefono) !== 10)) {
            throw new Exception("El teléfono debe ser numérico y tener 9 o 10 dígitos");
        }

        // Email opcional
        if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El email no es válido");
        }

        // Notas máximo 100
        if (strlen($notas) > 100) {
            throw new Exception("Las notas no pueden superar 100 caracteres");
        }
    }

    // RENDERIZAR (layout + vista)
    function renderizar($vista, $datos = [])
    {
        // Convierte array en variables: ['contactos'=>$x] -> $contactos
        extract($datos);

        // Construimos ruta real de la vista
        $archivoVista = __DIR__ . '/../Vistas/' . $vista . '.php';

        if (!file_exists($archivoVista)) {
            echo "Vista no encontrada: " . $vista;
            return;
        }

        // Variable que el layout va a requerir
        $vistaContenido = $archivoVista;

        // Cargamos el layout, que incluirá $vistaContenido
        require __DIR__ . '/../Vistas/layout.php';
    }

    // REGISTRAR ERRORES (persistencia)
    function registrarError($contexto, $e)
    {
        $archivoLog = __DIR__ . '/../../storage/errores.log';
        $fecha = date('Y-m-d H:i:s');

        $linea = $fecha . " | " . $contexto . " | " . $e->getMessage() . " | " . $e->getFile() . " | " . $e->getLine() . "\n";
        file_put_contents($archivoLog, $linea, FILE_APPEND);
    }
}