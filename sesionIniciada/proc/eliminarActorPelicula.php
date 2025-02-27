<?php
    include_once('../../conexion/conexion.php');
    $id_actor_pelicula = $_GET['id_actor_pelicula'];

    $eliminarRelacion = $conn->prepare("DELETE FROM actor_pelicula WHERE id_actor_pelicula = :id_actor_pelicula");
    $eliminarRelacion->bindParam(':id_actor_pelicula', $id_actor_pelicula);
    $eliminarRelacion->execute();

    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Relación eliminada',
        text: 'La relación entre el actor y sus películas han sido eliminadas.'
    }).then(() => {
        window.location.href = '../administrar.php';
    });
    </script>";
?>
