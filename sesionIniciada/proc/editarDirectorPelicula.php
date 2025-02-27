<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Director - Película</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/OIG.png" type="image/x-icon">
    <link rel="stylesheet" href="./editar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
</head>
<body class="banner">
    <h3 id="titulo">Editar Relación Director - Película</h3>
    <div class="page-border">
    <?php
        include_once("../../conexion/conexion.php");

        if (isset($_GET['id_director_pelicula'])) {

            $sqlRelacion = "SELECT id_director_pelicula, id_director, id_pelicula FROM director_pelicula WHERE id_director_pelicula = :id_director_pelicula";
            $stmtRelacion = $conn->prepare($sqlRelacion);
            $stmtRelacion->bindParam(':id_director_pelicula', $_GET['id_director_pelicula']);
            $stmtRelacion->execute();
            $relacion = $stmtRelacion->fetch(PDO::FETCH_ASSOC);

            $sqlDirectores = "SELECT id_director, nombre_director FROM directores";
            $stmtDirectores = $conn->prepare($sqlDirectores);
            $stmtDirectores->execute();
            $directores = $stmtDirectores->fetchAll(PDO::FETCH_ASSOC);

            $sqlPeliculas = "SELECT id_pelicula, nombre FROM peliculas";
            $stmtPeliculas = $conn->prepare($sqlPeliculas);
            $stmtPeliculas->execute();
            $peliculas = $stmtPeliculas->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <form id="editarRelacionForm" method="POST" style="text-align: center;">
        <input type="hidden" name="id_director_pelicula" value="<?php echo $relacion['id_director_pelicula']; ?>">

        <div class="inputs">
            <label for="director" class="textos5">Director</label><br>
            <select name="director" id="administraciones" required>
                <?php foreach ($directores as $director): ?>
                <option value="<?php echo $director['id_director']; ?>" <?php echo ($director['id_director'] == $relacion['id_director']) ? 'selected' : ''; ?>>
                    <?php echo $director['nombre_director']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="inputs">
            <label for="pelicula" class="textos5">Película</label><br>
            <select name="pelicula" id="administraciones" required>
                <?php foreach ($peliculas as $pelicula): ?>
                <option value="<?php echo $pelicula['id_pelicula']; ?>" <?php echo ($pelicula['id_pelicula'] == $relacion['id_pelicula']) ? 'selected' : ''; ?>>
                    <?php echo $pelicula['nombre']; ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <br>
        <button type="submit" class="btn btn-1" id="editarAdmin">Actualizar</button>
    </form>
    <?php } ?>
    </div>

    <script>
        document.getElementById('editarRelacionForm').onsubmit = actualizarRelacion;

        function actualizarRelacion(event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);

            fetch('procesoEditarDirectorPelicula.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "../administrar.php";
                } else {
                    alert('Este director ya ha sido asignado a esta película, o viceversa');
                    console.log(formData);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al actualizar la relación.');
            });
        }
    </script>
</body>
</html>