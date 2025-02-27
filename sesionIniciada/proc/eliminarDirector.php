<?php
include_once('../../conexion/conexion.php');

try {
    // Iniciar la transacción
    $conn->beginTransaction();

    $id_director = $_GET['id_director'];

    // Eliminar relaciones director-pelicula
    $eliminarRelacion = $conn->prepare("DELETE FROM director_pelicula WHERE id_director = :id_director");
    $eliminarRelacion->bindParam(':id_director', $id_director);
    $eliminarRelacion->execute();

    // Eliminar director
    $eliminarDirector = $conn->prepare("DELETE FROM directores WHERE id_director = :id_director");
    $eliminarDirector->bindParam(':id_director', $id_director);
    $eliminarDirector->execute();

    // Confirmar los cambios (commit)
    $conn->commit();

    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Director Eliminado',
        text: 'El director y todas sus relaciones han sido eliminadas.'
    }).then(() => {
        window.location.href = '../administrar.php';
    });
    </script>";

} catch (Exception $e) {
    // Si ocurre un error, revertir los cambios
    $conn->rollBack();
    echo "<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Ocurrió un error al eliminar el director o sus relaciones: " . $e->getMessage() . "'
    }).then(() => {
        window.location.href = '../administrar.php';
    });
    </script>";
}
?>