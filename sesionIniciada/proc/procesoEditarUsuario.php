<?php
include_once("../../conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_usuarios = $_POST['id_usuarios'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];

    // Procesar la contraseña
    if (!empty($contrasena)) {
        // Si se ingresa una nueva contraseña, se encripta
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
    } else {
        // Si no se ingresa una nueva contraseña, mantener la actual
        $contrasena = $_POST['contrasena_existente'];
    }

    // Preparar la consulta SQL
    $sqlUpdate = $conn->prepare('UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, contrasena = :contrasena, rol = :rol WHERE id_usuarios = :id_usuarios');
    $sqlUpdate->bindParam(':id_usuarios', $id_usuarios);
    $sqlUpdate->bindParam(':nombre', $nombre);
    $sqlUpdate->bindParam(':apellidos', $apellidos);
    $sqlUpdate->bindParam(':email', $email);
    $sqlUpdate->bindParam(':contrasena', $contrasena);
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