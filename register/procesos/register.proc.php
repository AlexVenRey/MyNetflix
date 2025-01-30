<?php
$usuario = $_POST["username"];
$apellido = $_POST["surname"];
$email = $_POST["email"];
$contrasena = $_POST["password"];
$hash = password_hash($contrasena, PASSWORD_BCRYPT);
$confirmar_contrasena = $_POST["conf_password"];
include("../../conexion/conexion.php");        


if (password_verify($confirmar_contrasena, $hash)) {

    $sql_insert_user = "INSERT INTO usuarios (nombre, apellidos, email, contrasena, rol) VALUES (:usuario, :apellidos, :email, :password, 1)";
    $stmt_insert_user = $conn->prepare($sql_insert_user);
    $stmt_insert_user->bindParam(':usuario',$usuario);
    $stmt_insert_user->bindParam(':apellidos',$apellido);
    $stmt_insert_user->bindParam(':email',$email);
    $stmt_insert_user->bindParam(':password',$hash);
    $stmt_insert_user->execute();
        
    header("location: ../../login/login.php");
}
?>
