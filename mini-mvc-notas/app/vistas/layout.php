<!DOCTYPE html> <!--LAYOUT PARA ENSEÑAR LOS BOTONES-->
<html>
<head>
    <meta charset="UTF-8">
    <title>MVC Notas</title>
</head>
<body>

<nav>
    <a href="index.php?accion=listar">Listar</a> |
    <a href="index.php?accion=crear">Crear</a>
</nav>

<hr>

<?php require $vistaContenido; ?>

</body>
</html>