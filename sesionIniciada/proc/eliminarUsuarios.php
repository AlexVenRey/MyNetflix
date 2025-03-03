<?php

    include_once('../../conexion/conexion.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $datos = json_decode(file_get_contents("php://input"), true);
    
        if (isset($datos['id_usuarios'])) {

            $id_usuarios = $datos['id_usuarios'];
    
            $eliminarUsuario = $conn->prepare("DELETE FROM usuarios WHERE id_usuarios = :id_usuarios");
            $eliminarUsuario->bindParam(':id_usuarios', $id_usuarios);
    
            $eliminarUsuario->execute();

            echo json_encode(['success' => true]);
            
        } else {

            echo json_encode(['success' => false, 'error' => 'ID de usuario no recibido.']);

        }
        
    } else {
        
        echo json_encode(['success' => false, 'error' => 'Método de solicitud inválido.']);

    }
    
    $conn = null;
    exit();
?>