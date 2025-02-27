<?php
include_once('../conexion/conexion.php');
$id_pelicula = $_GET['id_pelicula'];
$query = $conn->prepare("DELETE FROM peliculas WHERE id_pelicula = :id_pelicula");
$query->bindParam(':id_pelicula', $id_pelicula);
$query->execute();
header('Location: ../administrar.php');
?>