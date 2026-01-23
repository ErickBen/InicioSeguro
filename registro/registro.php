<?php
require "auth_admin.php";
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $telefono = preg_replace("/[^0-9]/", "", $_POST["telefono"]);
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];
    $rol = $_POST["rol"] === "admin" ? "admin" : "usuario";

    if (
        strlen($nombre) < 3 ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($telefono) != 10 ||
        strlen($password) < 8 ||
        $password !== $confirmar
    ) {
        header("Location: panel_admin.php?error=1");
        exit;
    }

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO usuarios (nombre, email, password, telefono, rol)
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $email, $passwordHash, $telefono, $rol);

    if ($stmt->execute()) {
        header("Location: panel_admin.php?success=1");
    } else {
        header("Location: panel_admin.php?error=2");
    }
}
