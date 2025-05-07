<?php
try {

    include_once("../conexion/conexion.php");

    $datos = json_decode(file_get_contents("php://input"), true);

    $usuarioId = $datos['usuarioId'] ?? null;
    $peliculaId = $datos['peliculaId'] ?? null;

    if (!$usuarioId || !$peliculaId) {
        echo json_encode(["estado" => "error", "mensaje" => "Faltan parámetros"]);
        exit;
    }

    $sql = "SELECT COUNT(*) FROM likes WHERE usuario = :usuarioId AND id_pelicula = :peliculaId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':usuarioId', $usuarioId);
    $stmt->bindParam(':peliculaId', $peliculaId);
    $stmt->execute();

    $likeEstado = $stmt->fetchColumn() > 0;

    echo json_encode(["likeEstado" => $likeEstado]);
    
} catch (PDOException $e) {
    echo json_encode(["estado" => "error", "mensaje" => "Error de conexión: " . $e->getMessage()]);
}
?>
