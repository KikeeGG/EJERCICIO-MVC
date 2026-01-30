<h2>Nueva asistencia</h2>
<!--FORMULARIO-->
<form method="POST" action="index.php?accion=guardar">
    <label>Nombre alumno:</label><br>
    <input type="text" name="nombreAlumno"><br><br>
    <label>¿Asiste?:</label><br>
    <select name="asiste">
        <option value="SI">SI</option>
        <option value="NO">NO</option>
    </select><br><br>
    <button type="submit">Guardar</button>
</form>