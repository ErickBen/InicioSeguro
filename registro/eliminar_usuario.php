<?php
require "auth_admin.php";
require "conexion.php";

$id = intval($_GET["id"]);

$conexion->query("DELETE FROM usuarios WHERE id = $id");

header("Location: panel_admin.php");
exit;
