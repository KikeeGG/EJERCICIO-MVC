<h2>Nueva nota</h2>
<!-- NUEVAS NOTAS-->
<?php if (!empty($error)): ?>
    <p style="color:red"><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form method="POST" action="index.php?accion=guardar">
    <textarea name="texto"><?php echo htmlspecialchars($antiguos['texto'] ?? ''); ?></textarea><br>
    <button type="submit">Guardar</button>
</form>