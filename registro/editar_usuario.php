<?php
require "auth_admin.php";
require "conexion.php";

$id = intval($_GET["id"]);

$resultado = $conexion->query("SELECT * FROM usuarios WHERE id = $id");
$usuario = $resultado->fetch_assoc();

if (!$usuario) {
    header("Location: panel_admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>

    <!-- CARGAR ESTILOS -->
    <link rel="stylesheet" href="estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<form id="registroForm" action="actualizar_usuario.php" method="POST">
    <h2>Editar usuario</h2>

    <input type="hidden" name="id" value="<?= $usuario["id"] ?>">

    <label>Nombre</label>
    <input type="text" name="nombre" value="<?= $usuario["nombre"] ?>" required>

    <label>Email</label>
    <input type="email" name="email" value="<?= $usuario["email"] ?>" required>

    <label>Teléfono</label>
    <input type="tel" name="telefono" value="<?= $usuario["telefono"] ?>" required>

    <label>Rol</label>
    <select name="rol" required>
        <option value="usuario" <?= $usuario["rol"]==="usuario" ? "selected" : "" ?>>Usuario</option>
        <option value="admin" <?= $usuario["rol"]==="admin" ? "selected" : "" ?>>Admin</option>
    </select>

    <button type="submit">Actualizar</button>
</form>

</body>
</html>
