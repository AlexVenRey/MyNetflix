<?php
include_once('../conexion/conexion.php');
$id_usuarios = $_GET['id_usuarios'];
$query = $conn->prepare("DELETE FROM usuarios WHERE id_usuarios = :id_usuarios");
$query->bindParam(':id_usuarios', $id_usuarios);
$query->execute();
header('Location: ../administrar.php');
?>