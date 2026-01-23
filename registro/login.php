<?php
// Mostrar errores SOLO en desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require "conexion.php";

// Seguridad: solo POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: login.html");
    exit;
}

// Verificar campos
if (!isset($_POST["email"], $_POST["password"])) {
    header("Location: login.html?error=1");
    exit;
}

// Sanitización
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$password = $_POST["password"];

// Validación backend
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || empty($password)) {
    header("Location: login.html?error=1");
    exit;
}

// Consulta preparada
$sql = "SELECT id, password, rol FROM usuarios WHERE email = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error en la consulta");
}

$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();

    if (password_verify($password, $usuario["password"])) {
        $_SESSION["id"] = $usuario["id"];
        $_SESSION["rol"] = $usuario["rol"];

        if ($usuario["rol"] === "admin") {
            header("Location: panel_admin.php");
        } else {
            header("Location: panel_usuario.php");
        }
        exit;
    }
}

// Credenciales inválidas
header("Location: login.html?error=2");
exit;
