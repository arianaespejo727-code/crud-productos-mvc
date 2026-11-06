<?php $editando = $producto["id"] !== ""; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $editando ? "Editar" : "Nuevo" ?> producto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="contenedor">
    <h1><?= $editando ? "Editar producto" : "Registrar producto" ?></h1>

    <?php if ($error): ?>
        <p class="mensaje error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="post" action="index.php" class="formulario">
        <input type="hidden" name="accion" value="<?= $editando ? "actualizar" : "guardar" ?>">
        <input type="hidden" name="id" value="<?= htmlspecialchars($producto["id"]) ?>">

        <label>Nombre</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($producto["nombre"]) ?>">

        <label>Categoría</label>
        <input type="text" name="categoria" value="<?= htmlspecialchars($producto["categoria"]) ?>">

        <label>Precio</label>
        <input type="text" name="precio" value="<?= htmlspecialchars($producto["precio"]) ?>">

        <button type="submit" class="verde"><?= $editando ? "Guardar cambios" : "Registrar" ?></button>
        <a href="index.php" class="boton gris">Cancelar</a>
    </form>
</div>
</body>
</html>