<?php

    include_once('../../conexion/conexion.php');
    $id_pelicula = $_GET['id_pelicula'];
    $eliminarPelicula = $conn->prepare("DELETE FROM peliculas WHERE id_pelicula = :id_pelicula");
    $eliminarPelicula->bindParam(':id_pelicula', $id_pelicula);
    $eliminarPelicula->execute();

    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Película Eliminada',
        text: 'La película ha sido eliminada.'
    }).then(() => {
        window.location.href = '../administrar.php';
    });
    </script>";

?>