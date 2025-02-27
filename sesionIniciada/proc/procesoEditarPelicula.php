<?php
include_once("../../conexion/conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_pelicula = $_POST['id_pelicula'];
    $pelicula = $_POST['pelicula'];
    $descripcion = $_POST['descripcion'];
    $ano = $_POST['ano'];
    $genero = $_POST['genero'];
    $edad = $_POST['edad'];

    // Procesar la portada
    if (!empty($_FILES['portada']['name'])) {

        $portada_subida = basename($_FILES['portada']['name']);
        
        if (move_uploaded_file($_FILES['portada']['tmp_name'], $portada_subida)) {
            $portada = $portada_subida;
        }

    } else {

        $portada = $_POST['portada_existente'];

    }

    // Procesar el tráiler
    // if (!empty($_FILES['trailer']['name'])) {

    //     $trailer_subido = basename($_FILES['trailer']['name']);
        
    //     if (move_uploaded_file($_FILES['trailer']['tmp_name'], $trailer_subido)) {
    //         $trailer = $trailer_subido;
    //     }

    // } else {

    //     $trailer = $_POST['trailer_existente'];

    // }

    // Procesar el vídeo
    // if (!empty($_FILES['video']['name'])) {

    //     $video_subido = basename($_FILES['video']['name']);
        
    //     if (move_uploaded_file($_FILES['video']['tmp_name'], $video_subido)) {
    //         $video = $video_subido;
    //     }

    // } else {

    //     $video = $_POST['video_existente'];

    // }

    // Procesar el logo
    if (!empty($_FILES['logo']['name'])) {

        $logo_subido = basename($_FILES['logo']['name']);
        
        if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo_subido)) {
            $logo = $logo_subido;
        }

    } else {

        $logo = $_POST['logo_existente'];

    }


    // Preparar la consulta SQL
    $sqlInsertar = $conn->prepare('UPDATE peliculas SET nombre = :nombre, descripcion = :descripcion, ano = :ano, genero = :genero, edad = :edad, portada = :portada, logo = :logo WHERE id_pelicula = :id_pelicula');
    $sqlInsertar->bindParam(':id_pelicula', $id_pelicula);
    $sqlInsertar->bindParam(':nombre', $pelicula);
    $sqlInsertar->bindParam(':descripcion', $descripcion);
    $sqlInsertar->bindParam(':ano', $ano);
    $sqlInsertar->bindParam(':genero', $genero);
    $sqlInsertar->bindParam(':edad', $edad);
    $sqlInsertar->bindParam(':portada', $portada);
    // $sqlInsertar->bindParam(':trailer', $trailer);
    // $sqlInsertar->bindParam(':pelicula', $video);
    $sqlInsertar->bindParam(':logo', $logo);

    // Ejecutar la consulta
    $sqlInsertar->execute();

    // Cerrar conexión
    $sqlInsertar->closeCursor();
    $conn = null;

    // Devolver respuesta en formato JSON
    echo json_encode(['success' => true]);
    exit();
}
?>
