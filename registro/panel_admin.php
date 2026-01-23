<?php
require "auth_admin.php";
require "conexion.php";

/* ===== OBTENER USUARIOS ===== */
$sql = "SELECT id, nombre, email, telefono, rol FROM usuarios";
$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error al obtener usuarios");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador</title>

    <link rel="stylesheet" href="estilos.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<div class="panel">

    <h2>Panel del Administrador</h2>
    <a href="logout.php">Salir</a>
    
    <!-- MENSAJE DE REGISTRO EXITOSO -->
    <?php if (isset($_GET["success"]) && $_GET["success"] == 1): ?>
        <p id="mensaje" style="color: green; margin-top: 1rem;">
            ✔ Usuario registrado exitosamente
        </p>
    <?php endif; ?>

    <hr><br>

   

    <!-- LISTADO DE USUARIOS -->
    <h3>Usuarios registrados</h3>

    <table>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>

        <?php if ($resultado->num_rows > 0): ?>
            <?php while ($u = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($u["nombre"]) ?></td>
                <td><?= htmlspecialchars($u["email"]) ?></td>
                <td><?= htmlspecialchars($u["telefono"]) ?></td>
                <td><?= $u["rol"] ?></td>
                <td>
                    <a href="editar_usuario.php?id=<?= $u["id"] ?>">Editar</a> |
                    <a href="eliminar_usuario.php?id=<?= $u["id"] ?>"
                       onclick="return confirm('¿Eliminar usuario?')">
                       Eliminar
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5">No hay usuarios registrados</td>
            </tr>
        <?php endif; ?>
    </table>
     <hr><br>

     <!-- REGISTRO DE USUARIOS -->

    <h3>Registrar nuevo usuario</h3>   <br>
    <a href="registrar.html">NuevoUsuario</a>




</div>

</body>
</html>
