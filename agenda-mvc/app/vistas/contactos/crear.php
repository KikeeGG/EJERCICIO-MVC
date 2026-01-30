<?php
// app/Vistas/contactos/crear.php

$antiguos = $antiguos ?? ['nombre'=>'', 'telefono'=>'', 'email'=>'', 'notas'=>''];
?>

<?php if (!empty($error)): ?>
  <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<div class="tarjeta">
  <h2>Nuevo contacto</h2>

  <form method="POST" action="index.php?accion=guardar">

    <label>Nombre (mín. 3 caracteres)</label>
    <input type="text" name="nombre" value="<?php echo htmlspecialchars($antiguos['nombre']); ?>" required>

    <label>Teléfono (9 o 10 dígitos)</label>
    <input type="text" name="telefono" value="<?php echo htmlspecialchars($antiguos['telefono']); ?>" required>

    <label>Email (opcional)</label>
    <input type="text" name="email" value="<?php echo htmlspecialchars($antiguos['email']); ?>">

    <label>Notas (opcional, máx. 100 caracteres)</label>
    <textarea name="notas" maxlength="100"><?php echo htmlspecialchars($antiguos['notas']); ?></textarea>

    <button type="submit">Guardar</button>
  </form>
</div>
