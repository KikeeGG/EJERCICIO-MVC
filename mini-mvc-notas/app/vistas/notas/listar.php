<h2>Listado de notas</h2> <!--ENSEÑA EL LISTADO DE NOTAS-->

<?php if (!empty($error)): ?>
    <p style="color:red"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if (empty($notas)): ?>
    <p>No hay notas</p>
<?php else: ?>
<table border="1">
    <tr>
        <th>Fecha</th>
        <th>Texto</th>
    </tr>
    <?php foreach ($notas as $n): ?>
        <tr>
            <td><?php echo htmlspecialchars($n->fecha); ?></td>
            <td><?php echo htmlspecialchars($n->texto); ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<?php endif; ?>
