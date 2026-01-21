<?php
require "conexion.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitización
    $nombre = trim($_POST["nombre"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $telefono = preg_replace("/[^0-9]/", "", $_POST["telefono"]);
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];

    // Validaciones backend
    if (
        strlen($nombre) < 3 ||
        !filter_var($email, FILTER_VALIDATE_EMAIL) ||
        strlen($telefono) != 10 ||
        strlen($password) < 8 ||
        $password !== $confirmar
    ) {
        header("Location: index.html?error=1");
        exit;
    }

    // Hash seguro
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Consulta preparada
    $sql = "INSERT INTO usuarios (nombre, email, password, telefono)
            VALUES (?, ?, ?, ?)";

    $stmt = $conexion->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $nombre, $email, $passwordHash, $telefono);

        if ($stmt->execute()) {
            header("Location: index.html?success=1");
            exit;
        } else {
            header("Location: index.html?error=2");
            exit;
        }
    } else {
        header("Location: index.html?error=3");
        exit;
    }
}
