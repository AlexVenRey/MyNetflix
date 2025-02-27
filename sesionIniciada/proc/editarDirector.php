<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Director</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/OIG.png" type="image/x-icon">
    <link rel="stylesheet" href="./editar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
</head>
<body class="banner">
    <h3 id="titulo">Editar Director</h3>
    <div class="page-border">
    <?php
        include_once("../../conexion/conexion.php");
        if (isset($_GET['id_director'])) {
            $sqlDirector = "SELECT id_director, nombre_director FROM directores WHERE id_director = :id_director";
            $stmtDirector = $conn->prepare($sqlDirector);
            $stmtDirector->bindParam(':id_director', $_GET['id_director']);
            $stmtDirector->execute();
            $director = $stmtDirector->fetch(PDO::FETCH_ASSOC);
    ?>
    <form id="editarDirectorForm" method="POST" style="text-align: center;">
        <input type="hidden" name="id_director" value="<?php echo $director['id_director']; ?>">
        <div class="inputs">
        <label for="director" class="textos5">Nombre del Director</label><br>
        <input type="text" name="director" id="administraciones" value="<?php echo $director['nombre_director']; ?>" required>
        </div>
        <br>
        <button type="submit" class="btn btn-1" id="editarAdmin">Actualizar</button>
    </form>
    <?php } ?>
    </div>

    <script>
        document.getElementById('editarDirectorForm').onsubmit = actualizarDirector;

        function actualizarDirector(event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);

            fetch('procesoEditarDirector.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
            if (data.success) {

                window.location.href = "../administrar.php";

            } else {

                alert('Error al actualizar el director');

            }
            })
            .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al actualizar el director.');
            });
        }
    </script>
</body>
</html>