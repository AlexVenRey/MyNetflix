<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Genero</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/OIG.png" type="image/x-icon">
    <link rel="stylesheet" href="./editar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
</head>
<body class="banner">
    <h3 id="titulo">Editar Género</h3>
    <div class="page-border">
    <?php
        include_once("../../conexion/conexion.php");
        if (isset($_GET['id_genero'])) {
            $sqlGenero = "SELECT id_genero, nombre FROM genero WHERE id_genero = :id_genero";
            $stmtGenero = $conn->prepare($sqlGenero);
            $stmtGenero->bindParam(':id_genero', $_GET['id_genero']);
            $stmtGenero->execute();
            $genero = $stmtGenero->fetch(PDO::FETCH_ASSOC);
    ?>
    <form id="editarGeneroForm" method="POST" style="text-align: center;">
        <input type="hidden" name="id_genero" value="<?php echo $genero['id_genero']; ?>">
        <div class="inputs">
        <label for="genero" class="textos5">Nombre del Género</label><br>
        <input type="text" name="genero" id="administraciones" value="<?php echo $genero['nombre']; ?>" required>
        </div>
        <br>
        <button type="submit" class="btn btn-1" id="editarAdmin">Actualizar</button>
    </form>
    <?php } ?>
    </div>

    <script>
        document.getElementById('editarGeneroForm').onsubmit = actualizarGenero;

        function actualizarGenero(event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);

            fetch('procesoEditarGenero.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
            if (data.success) {

                window.location.href = "../administrar.php";

            } else {

                alert('Error al actualizar el género');

            }
            })
            .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al actualizar el género.');
            });
        }
    </script>
</body>
</html>