<?php
try {
    include_once("./conexion/conexion.php");
    // Verifica que se han recibido los parámetros necesarios
    if(isset($_GET['peliculaId']) && isset($_GET['usuarioId']) && isset($_GET['accion'])) {
        // Recoge los valores de los parámetros
        $peliculaId = $_GET['peliculaId'];
        $usuarioId = $_GET['usuarioId'];
        $accion = $_GET['accion'];
        $ValorLike = 1;
        $ValorDislike = 0;

        // Verifica si es un like o un dislike
        if ($accion === "like") {
            // Inserta en la base de datos según la acción
            $sqlLike = "INSERT INTO likes (`usuario`, `like/dislike`, `id_pelicula`) VALUES (:usuarioId, :darlike, :peliculaId)";
            $stmtLike = $conn->prepare($sqlLike);
            $stmtLike->bindParam(':usuarioId', $usuarioId);
            $stmtLike->bindParam(':darlike', $ValorLike); // 1 para like
            $stmtLike->bindParam(':peliculaId', $peliculaId);
            $stmtLike->execute();

            header("Location: index.php");
            exit();
            
        } elseif ($accion === "dislike") {
            // Inserta en la base de datos según la acción
            $sqlLike = "INSERT INTO likes (`usuario`, `like/dislike`, `id_pelicula`) VALUES (:usuarioId, :dardislike, :peliculaId)";
            $stmtLike = $conn->prepare($sqlLike);
            $stmtLike->bindParam(':usuarioId', $usuarioId);
            $stmtLike->bindParam(':dardislike', $ValorDislike); // 0 para dislike
            $stmtLike->bindParam(':peliculaId', $peliculaId);
            $stmtLike->execute();

            header("Location: index.php");
            exit();
            
        }
    } else {
        // Manejo de error si no se reciben los parámetros necesarios
        echo "No has seleccionado la película";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>