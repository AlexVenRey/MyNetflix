<?php
try {
    include_once("../conexion/conexion.php");

    if (isset($_GET['peliculaId']) && isset($_GET['usuarioId'])) {
        $peliculaId = $_GET['peliculaId'];
        $usuarioId = $_GET['usuarioId'];
        $valorLike = 1;

        // Comprobar si ya hay like
        $consulta = "SELECT * FROM likes WHERE usuario = :usuarioId AND id_pelicula = :peliculaId";
        $stmt = $conn->prepare($consulta);
        $stmt->bindParam(':usuarioId', $usuarioId);
        $stmt->bindParam(':peliculaId', $peliculaId);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Ya hay like: eliminarlo
            $eliminar = "DELETE FROM likes WHERE usuario = :usuarioId AND id_pelicula = :peliculaId";
            $stmtEliminar = $conn->prepare($eliminar);
            $stmtEliminar->bindParam(':usuarioId', $usuarioId);
            $stmtEliminar->bindParam(':peliculaId', $peliculaId);
            $stmtEliminar->execute();

            echo "Like eliminado.";
        } else {
            // No hay like: insertarlo
            $insertar = "INSERT INTO likes (usuario, `like`, id_pelicula) VALUES (:usuarioId, :valorLike, :peliculaId)";
            $stmtInsertar = $conn->prepare($insertar);
            $stmtInsertar->bindParam(':usuarioId', $usuarioId);
            $stmtInsertar->bindParam(':valorLike', $valorLike);
            $stmtInsertar->bindParam(':peliculaId', $peliculaId);
            $stmtInsertar->execute();

            echo "Like agregado.";
        }
    } else {
        echo "Faltan parámetros.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
