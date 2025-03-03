<?php

    include_once('../../conexion/conexion.php');

    
    try {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = json_decode(file_get_contents("php://input"), true);

            if (isset($datos['id_rol'])) {
            
                $id_rol = $datos['id_rol'];

                // Iniciar una transacción
                $conn->beginTransaction();
        
                $eliminarUsuario = $conn->prepare("DELETE FROM usuarios WHERE rol = :id_rol");
                $eliminarUsuario->bindParam(':id_rol', $id_rol);
                $eliminarUsuario->execute();
        
                $eliminarRol = $conn->prepare("DELETE FROM roles WHERE id_rol = :id_rol");
                $eliminarRol->bindParam(':id_rol', $id_rol);
                $eliminarRol->execute();
        
                // Confirmar la transacción
                $conn->commit();
        
                echo json_encode(['success' => true]);
                
            } else {
            
                echo json_encode(['success' => false, 'error' => 'ID de rol no recibido.']);
                exit();

            }
            
        } else {

            echo json_encode(['success' => false, 'error' => 'Método de solicitud inválido.']);
            exit();

        }

    } catch (Exception $e) {

        $conn->rollBack();
        echo json_encode(['success' => false, 'error' => 'Error al eliminar: ' . $e->getMessage()]);

    }
?>