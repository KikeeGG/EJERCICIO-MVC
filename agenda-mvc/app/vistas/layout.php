<?php
// app/Vistas/layout.php
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agenda MVC</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 20px; }
    .contenedor { max-width: 900px; margin: 0 auto; }
    .menu a { margin-right: 12px; }
    table { width: 100%; border-collapse: collapse; margin-top: 12px; }
    th, td { border: 1px solid #ccc; padding: 8px; }
    th { background: #f5f5f5; }
    .error { background: #ffe6e6; border: 1px solid #ffb3b3; padding: 10px; margin: 10px 0; }
    .tarjeta { border: 1px solid #ddd; padding: 12px; border-radius: 8px; margin-top: 12px; }
    label { display:block; margin-top: 10px; }
    input, textarea { width: 100%; padding: 8px; }
    button { padding: 10px 14px; margin-top: 12px; cursor: pointer; }
  </style>
</head>
<body>
  <div class="contenedor">
    <h1>Agenda MVC (TXT)</h1>

    <div class="menu">
      <a href="index.php?accion=listar">📋 Listar</a>
      <a href="index.php?accion=crear">➕ Nuevo contacto</a>
    </div>

    <hr>

    <?php
      // Aquí se inserta la vista concreta (listar.php o crear.php, etc.)
      require $vistaContenido;
    ?>

  </div>
</body>
</html>