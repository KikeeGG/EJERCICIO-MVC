<?php if (!empty($error)): ?>
  <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="tarjeta">
  <h2>Listado de cursos</h2>
  <?php if (empty($cursos)): ?>
    <p>No hay cursos todavía.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Nombre</th>
          <th>Horas</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cursos as $c): ?>
          <tr>
            <td><?php echo htmlspecialchars($c->fechaCreacion); ?></td>
            <td><?php echo htmlspecialchars($c->nombre); ?></td>
            <td><?php echo htmlspecialchars($c->horas); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>