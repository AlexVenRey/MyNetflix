<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

include_once('../../conexion/conexion.php');

try {

    // Iniciar la transacción
    $conn->beginTransaction();

    $id_actor = $_GET['id_actor'];

    $eliminarRelacion = $conn->prepare("DELETE FROM actor_pelicula WHERE id_actor = :id_actor");
    $eliminarRelacion->bindParam(':id_actor', $id_actor);
    $eliminarRelacion->execute();

    $eliminarActor = $conn->prepare("DELETE FROM actores WHERE id_actor = :id_actor");
    $eliminarActor->bindParam(':id_actor', $id_actor);
    $eliminarActor->execute();

    // Confirmar los cambios (commit)
    $conn->commit();

    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Actor Eliminado',
        text: 'El actor y todas y sus relaciones han sido eliminadas.'
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
        text: 'Ocurrió un error al eliminar el actor o sus relaciones: " . $e->getMessage() . "'
    }).then(() => {
        window.location.href = '../administrar.php';
    });
    </script>";

}
?>
