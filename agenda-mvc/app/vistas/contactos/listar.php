<?php
// app/Vistas/contactos/listar.php
?>

<?php if (!empty($error)): ?>
  <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="tarjeta">
  <h2>Listado de contactos</h2>

  <?php if (empty($contactos)): ?>
    <p>No hay contactos todavía.</p>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Notas</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($contactos as $c): ?>
          <tr>
            <td><?php echo htmlspecialchars($c->fechaCreacion); ?></td>
            <td><?php echo htmlspecialchars($c->nombre); ?></td>
            <td><?php echo htmlspecialchars($c->telefono); ?></td>
            <td><?php echo htmlspecialchars($c->email); ?></td>
            <td><?php echo htmlspecialchars($c->notas); ?></td>
            <td>
              <a href="index.php?accion=borrar&id=<?php echo urlencode($c->id); ?>"
                 onclick="return confirm('¿Seguro que quieres borrar este contacto?');">
                🗑 Borrar
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
</div>
