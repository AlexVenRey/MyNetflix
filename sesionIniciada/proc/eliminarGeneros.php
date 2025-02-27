<?php

    include_once('../../conexion/conexion.php');

    try {

        // Iniciar la transacción
        $conn->beginTransaction();

        $id_genero = $_GET['id_genero'];

        $eliminarPelicula = $conn->prepare("DELETE FROM peliculas WHERE genero = :id_genero");
        $eliminarPelicula->bindParam(':id_genero', $id_genero);
        $eliminarPelicula->execute();


        $eliminarGenero = $conn->prepare("DELETE FROM genero WHERE id_genero = :id_genero");
        $eliminarGenero->bindParam(':id_genero', $id_genero);
        $eliminarGenero->execute();

        // Confirmar los cambios (commit)
        $conn->commit();

        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Género Eliminado',
            text: 'El género y todas las películas asociadas han sido eliminados.'
        }).then(() => {
            window.location.href = '../administrar.php';
        });
        </script>";

    } catch (Exception $e) {

        $conn->rollBack();
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al género o la película: " . $e->getMessage() . "'
        }).then(() => {
            window.location.href = '../administrar.php';
        });
        </script>";

    }

?>
