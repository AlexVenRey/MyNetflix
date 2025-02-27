<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Películas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/OIG.png" type="image/x-icon">
    <link rel="stylesheet" href="./editar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
</head>
<body class="banner" style="justify-content: normal;">
    <h3 id="titulo">Editar Películas</h3>
    <div class="page-border">
        <?php
        include_once("../../conexion/conexion.php");

        if (isset($_GET['id_pelicula'])) {
            $sqlPeliculas = "SELECT id_pelicula AS id_pelicula, peliculas.nombre AS Pelicula, descripcion AS Descripcion, ano AS Año, genero.nombre AS Genero,
            edad AS Edad, portada AS Portada, trailer AS Trailer, pelicula AS Video, logo AS Logo FROM peliculas LEFT JOIN genero ON genero.id_genero = peliculas.genero
            WHERE id_pelicula = :id_pelicula ORDER BY id_pelicula ASC";
            $stmtPeliculas = $conn->prepare($sqlPeliculas);
            $stmtPeliculas->bindParam(':id_pelicula',$_GET['id_pelicula']);
            $stmtPeliculas->execute();
            $resultado = $stmtPeliculas->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultado as $row) {
        ?>   
        <form id="editarPeliculaForm" method="POST" enctype="multipart/form-data" style="text-align: center;">
            <input type="hidden" name="id_pelicula" id="administraciones"  value="<?php echo $row['id_pelicula']; ?>">
            <div class="inputs">
                <label for="pelicula" class="textos5">Película</label>
                <br>
                <input type="text" name="pelicula" id="administraciones"  value="<?php echo $row['Pelicula']; ?>" required>
            </div>
            <div class="inputs">
                <label for="descripcion" class="textos5">Descripción</label>
                <br>
                <input type="text" name="descripcion" id="administraciones"  value="<?php echo $row['Descripcion']; ?>" required>
            </div>
            <div class="inputs">
                <label for="ano" class="textos5">Año</label>
                <br>
                <input type="number" name="ano" id="administraciones"  value="<?php echo $row['Año']; ?>" required>
            </div>
            <div class="inputs">
                <label for="genero" class="textos5">Género</label>
                <br>
                <select name='genero' id="administraciones" >
                    <?php
                    $sqlGeneros = "SELECT id_genero, nombre FROM genero";
                    $stmtGeneros = $conn->prepare($sqlGeneros);
                    $stmtGeneros->execute();
                    $generos = $stmtGeneros->fetchAll(PDO::FETCH_ASSOC);
                    
                    foreach ($generos as $generoOption) {
                        ?>
                        <option value="<?php echo $generoOption['id_genero']; ?>" <?php if ($generoOption['nombre'] == $row['Genero']) { echo 'selected'; } ?>><?php echo $generoOption['nombre']; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="inputs">
                <label for="edad" class="textos5">Edad</label>
                <br>
                <input type="number" name="edad" id="administraciones" value="<?php echo $row['Edad']; ?>" required>
            </div>
            <div class="inputs">
                <label for="portada" class="textos5">Portada</label>
                <br>
                <div id="divRutas">
                    <?php if (file_exists('../../img/' . $row['Portada'])): ?>
                        <img id="imgRutas" src="../../img/<?php echo htmlspecialchars($row['Portada']); ?>">
                    <?php else: ?>
                        <p style="color:white; font-weight: 800;" ><?php echo htmlspecialchars($row['Portada']); ?></p>
                    <?php endif; ?>
                </div>
                <input type="hidden" name="portada_existente" value="<?php echo htmlspecialchars($row['Portada']); ?>">
                <input type="file" style="color:white;" name="portada">
            </div>
            <!-- <div class="inputs">
                <label for="trailer" class="textos5">Tráiler</label>
                <br>
                <div id="divRutas">
                    <?php if (file_exists('../../video/' . $row['Trailer'])): ?>
                        <video id="vidRutas" src="../../video/<?php echo htmlspecialchars($row['Trailer']); ?>" controls></video>
                    <?php else: ?>
                        <p style="color:white; font-weight: 800;" ><?php echo htmlspecialchars($row['Trailer']); ?></p>
                    <?php endif; ?>
                </div>
                <input type="hidden" name="trailer_existente" value="<?php echo htmlspecialchars($row['Trailer']); ?>">
                <input type="file" style="color:white;" name="trailer">
            </div>
            <div class="inputs">
                <label for="video" class="textos5">Vídeo</label>
                <br>
                <div id="divRutas">
                    <?php if (file_exists('../../video/' . $row['Video'])): ?>
                        <video id="vidRutas" src="../../video/<?php echo htmlspecialchars($row['Video']); ?>"></video>
                    <?php else: ?>
                        <p style="color:white; font-weight: 800;" ><?php echo htmlspecialchars($row['Video']); ?></p>
                    <?php endif; ?>
                </div>
                <input type="hidden" name="video_existente" value="<?php echo htmlspecialchars($row['Video']); ?>">
                <input type="file" style="color:white;" name="video">
            </div> -->
            <div class="inputs">
                <label for="logo" class="textos5">Logo</label>
                <br>
                <div id="divRutas">
                    <?php if (file_exists('../../img/' . $row['Logo'])): ?>
                        <img id="logoRutas" src="../../img/<?php echo htmlspecialchars($row['Logo']); ?>">
                    <?php else: ?>
                        <p style="color:white; font-weight: 800;" ><?php echo htmlspecialchars($row['Logo']); ?></p>
                    <?php endif; ?>
                </div>
                <input type="hidden" name="logo_existente" value="<?php echo htmlspecialchars($row['Logo']); ?>">
                <input type="file" style="color:white;" name="logo">
            </div>
            <br>
            <button type="submit" class="btn btn-1" id="editarAdmin">Actualizar</button>
        </form>
        <?php
            }
        } else {
            header('Location: ../administrar.php');
        }
        ?>
    </div>

    <script>

        var formulario = document.getElementById('editarPeliculaForm');

        formulario.onsubmit = actualizarPelicula;

        // Función para actualizar los datos de la película
        function actualizarPelicula(event) {

            //Evitamos recargar la página
            event.preventDefault();

            // Obtenemos los datos del formulario
            var form = event.target;

            // Creamos un objeto FormData con los datos del formulario
            var formData = new FormData(form);

            // Enviamos los datos al servidor usando Fetch
            fetch('procesoEditarPelicula.php', {
                method: 'POST',
                body: formData
            })
            // Procesamos la respuesta del servidor
            .then(response => response.json())
            .then(data => {
                // Si los datos son correctos, redirigimos al usuario a la página de administración
                // si ha habido algún error, mostramos un mensaje de error
                if (data.success) {
                    
                    window.location.href = "../administrar.php";

                } else {
                    
                    console.error('Error en la actualización:', data.error);
                    alert('Error al actualizar la película.');

                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error en la actualización.');
            });
        }

    </script>
</body>
</html>
