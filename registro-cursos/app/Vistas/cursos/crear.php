<?php
$antiguos = $antiguos ?? ['nombre' => '', 'horas' => ''];
?>
<?php if (!empty($error)): ?>
  <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="tarjeta">
  <h2>Nuevo curso</h2>

  <form method="POST" action="index.php?accion=guardar">

    <label>Nombre del curso</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($antiguos['nombre']); ?>" required>

    <label>Horas (número entero)</label>
    <input type="text" name="horas" value="<?php echo htmlspecialchars($antiguos['horas']); ?>" required>

    <button type="submit">Guardar curso</button>
  </form>
</div>