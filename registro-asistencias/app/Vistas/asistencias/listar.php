<h2>Listado de asistencias</h2>
<table border="1">
    <tr>
        <th>Nombre alumno</th>
        <th>Fecha</th>
        <th>Asiste</th>
    </tr>
    <?php foreach($asistencias as $a): ?>
        <?php if($a ===null): ?>
            <tr>
                <td colspan="3">Registro corrupto (ver errores.log)</td>
            </tr>
        <?php else: ?>
            <tr>
                <td><?= htmlspecialchars($a->nombreAlumno) ?></td> <!--ANTI XSS-->
                <td><?= $a->fecha ?></td>
                <td><?= $a->asiste ?></td>
            </tr>
        <?php endif; ?>
    <?php endforeach; ?>
</table>