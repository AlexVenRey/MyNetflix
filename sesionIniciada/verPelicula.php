<?php

include_once("../conexion/conexion.php");

// verPelicula.php
$peliculaId = $_GET['peliculaId'] ?? null;

if (!$peliculaId) {
    header("Location: ../login/login.php");
    exit();
}
$sql = "SELECT trailer, nombre FROM peliculas WHERE id_pelicula = :peliculaId";
$stmt = $conn->prepare($sql);
$stmt->execute([':peliculaId' => $peliculaId]);
$pelicula = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$pelicula) {
    die("Película no encontrada.");
}

$trailer = $pelicula['trailer'];
$titulo = $pelicula['nombre'];

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reproductor de Video</title>
    <style>
        /* Estilo para hacer que el video ocupe toda la pantalla */
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
            background: black;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        video {
            width: 100%;
            height: 100vh; /* Ocupa toda la altura de la ventana */
            object-fit: cover; /* Ajusta el video al tamaño de la ventana sin distorsionar */
        }
    </style>
</head>
<body>
    <video controls autoplay>
        <source src="../video/<?php echo htmlspecialchars($trailer); ?>" type="video/mp4">
        Tu navegador no soporta el reproductor de video.
    </video>
</body>
</html>
