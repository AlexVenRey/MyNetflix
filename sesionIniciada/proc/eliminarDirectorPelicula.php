<?php
include_once('../../conexion/conexion.php');
$id_director_pelicula = $_GET['id_director_pelicula'];

// Eliminar la relación director-película
$eliminarRelacion = $conn->prepare("DELETE FROM director_pelicula WHERE id_director_pelicula = :id_director_pelicula");
$eliminarRelacion->bindParam(':id_director_pelicula', $id_director_pelicula);
$eliminarRelacion->execute();

echo "<script>
Swal.fire({
    icon: 'success',
    title: 'Relación eliminada',
    text: 'La relación entre el director y su películas han sido eliminadas.'
}).then(() => {
    window.location.href = '../administrar.php';
});
</script>";

?>