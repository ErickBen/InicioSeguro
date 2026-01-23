<?php
require "auth_admin.php";
require "conexion.php";

$id = intval($_POST["id"]);
$nombre = trim($_POST["nombre"]);
$email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$telefono = preg_replace("/[^0-9]/", "", $_POST["telefono"]);
$rol = $_POST["rol"] === "admin" ? "admin" : "usuario";

$sql = "UPDATE usuarios SET nombre=?, email=?, telefono=?, rol=? WHERE id=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssi", $nombre, $email, $telefono, $rol, $id);

$stmt->execute();

header("Location: panel_admin.php");
exit;
