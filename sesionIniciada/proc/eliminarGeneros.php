<?php

    include_once('../../conexion/conexion.php');

    try {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $datos = json_decode(file_get_contents("php://input"), true);

            if (isset($datos['id_genero'])) {

                // Iniciar la transacción
                $conn->beginTransaction();
    
                $id_genero = $datos['id_genero'];
    
                $eliminarPelicula = $conn->prepare("DELETE FROM peliculas WHERE genero = :id_genero");
                $eliminarPelicula->bindParam(':id_genero', $id_genero);
                $eliminarPelicula->execute();
    
                $eliminarGenero = $conn->prepare("DELETE FROM genero WHERE id_genero = :id_genero");
                $eliminarGenero->bindParam(':id_genero', $id_genero);
                $eliminarGenero->execute();
    
                // Confirmar los cambios (commit)
                $conn->commit();

                echo json_encode(['success' => true]);

                exit();
                
            } else {

                echo json_encode(['success' => false, 'error' => 'ID de género no recibido.']);
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
