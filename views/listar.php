<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Gestión de productos</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="contenedor">
<h1>Gestión de productos - MVC</h1>

<?php if ($mensaje): ?>
    <p class="mensaje <?= $mensaje["tipo"] ?>"><?= htmlspecialchars($mensaje["texto"]) ?></p>
<?php endif; ?>

<form method="get" action="index.php" class="buscador">
    <input type="text" name="q" placeholder="Buscar por código o nombre" value="<?= htmlspecialchars($busqueda) ?>">
    <button type="submit">Buscar</button>
    <a href="index.php" class="boton gris">Ver todos</a>
    <a href="index.php?accion=crear" class="boton verde">+ Nuevo producto</a>
</form>

<table>
    <tr>
        <th>Código</th><th>Nombre</th><th>Categoría</th><th>Precio</th><th>Acciones</th>
    </tr>
    <?php if (empty($productos)): ?>
        <tr><td colspan="5">No se encontraron productos.</td></tr>
    <?php else: ?>
        <?php foreach ($productos as $p): ?>
            <tr>
                <td><?= $p["id"] ?></td>
                <td><?= htmlspecialchars($p["nombre"]) ?></td>
                <td><?= htmlspecialchars($p["categoria"]) ?></td>
                <td>S/ <?= number_format($p["precio"], 2) ?></td>
                <td class="acciones">
                    <a href="index.php?accion=editar&id=<?= $p["id"] ?>" class="boton azul">Editar</a>
                    <form method="post" action="index.php" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')">
                        <input type="hidden" name="accion" value="eliminar">
                        <input type="hidden" name="id" value="<?= $p["id"] ?>">
                        <button type="submit" class="rojo">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>
</div>
</body>
</html>