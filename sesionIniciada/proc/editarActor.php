<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Actor</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/OIG.png" type="image/x-icon">
    <link rel="stylesheet" href="./editar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
</head>
<body class="banner">
    <h3 id="titulo">Editar Actor</h3>
    <div class="page-border">
    <?php
        include_once("../../conexion/conexion.php");
        if (isset($_GET['id_actor'])) {
            $sqlActor = "SELECT id_actor, nombre_actor FROM actores WHERE id_actor = :id_actor";
            $stmtActor = $conn->prepare($sqlActor);
            $stmtActor->bindParam(':id_actor', $_GET['id_actor']);
            $stmtActor->execute();
            $actor = $stmtActor->fetch(PDO::FETCH_ASSOC);
    ?>
    <form id="editarActorForm" method="POST" style="text-align: center;">
        <input type="hidden" name="id_actor" value="<?php echo $actor['id_actor']; ?>">
        <div class="inputs">
        <label for="actor" class="textos5">Nombre del Actor</label><br>
        <input type="text" name="actor" id="administraciones" value="<?php echo $actor['nombre_actor']; ?>" required>
        </div>
        <br>
        <button type="submit" class="btn btn-1" id="editarAdmin">Actualizar</button>
    </form>
    <?php } ?>
    </div>

    <script>
        document.getElementById('editarActorForm').onsubmit = actualizarActor;

        function actualizarActor(event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);

            fetch('procesoEditarActor.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
            if (data.success) {

                window.location.href = "../administrar.php";

            } else {

                alert('Error al actualizar el actor');

            }
            })
            .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al actualizar el actor.');
            });
        }
    </script>
</body>
</html>