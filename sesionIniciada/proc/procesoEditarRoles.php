<?php
include_once("../../conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Obtener los datos del formulario
    $id_rol = $_POST['id_rol'];
    $rol = $_POST['rol'];

    // Preparar la consulta SQL para actualizar el rol
    $sqlUpdate = $conn->prepare('UPDATE roles SET rol = :rol WHERE id_rol = :id_rol');
    $sqlUpdate->bindParam(':id_rol', $id_rol);
    $sqlUpdate->bindParam(':rol', $rol);

    // Ejecutar la consulta
    $sqlUpdate->execute();

    // Cerrar conexión
    $sqlUpdate->closeCursor();
    $conn = null;

    // Devolver respuesta en formato JSON
    echo json_encode(['success' => true]);
    exit();
}
?>