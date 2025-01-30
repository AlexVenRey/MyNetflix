
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Peliculas</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="shortcut icon" href="../img/OIG.png" type="image/x-icon">
        <link rel="stylesheet" href="../editar.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    </head>
    <body class="banner">
    <h3 id="titulo">Editar Películas</h3>
    <div class="page-border">
        <?php
        include_once("../conexion/conexion.php");//incluimos archivo de conexion
            try{
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
                    <form action="" method="POST" style="text-align: center;">
                        <input type="hidden" name="id_usuarios" value="<?php echo $row['id_pelicula']; ?>">
                        <div class="inputs">
                            <label for="pelicula" class="textos5">Película</label>
                            <br>
                            <input type="text" name="pelicula" id="administraciones" value="<?php echo $row['Pelicula']; ?>" required>
                        </div>
                        <div class="inputs">
                            <label for="descripcion" class="textos5">Descripción</label>
                            <br>
                            <input type="text" name="descripcion" id="administraciones" value="<?php echo $row['Descripcion']; ?>" required>
                        </div>
                        <div class="inputs">
                            <label for="ano" class="textos5">Año</label>
                            <br>
                            <input type="number" name="ano" id="administraciones" value="<?php echo $row['Año']; ?>" required>
                        </div>
                        <div class="inputs">
                            <label for="genero" class="textos5">Género</label>
                            <br>
                            <select name='genero' id="administraciones">
                                <?php
                                $sqlGeneros = "SELECT id_genero, nombre FROM genero";
                                // Preparación y ejecución de la consulta para obtener mesas
                                $stmtGeneros = $conn->prepare($sqlGeneros);
                                $stmtGeneros->execute();
                                $generos = $stmtGeneros->fetchAll(PDO::FETCH_ASSOC);
                                //mostramos las roles de la bd que tenemos guardadas en el array
                                foreach ($generos as $generoOption) {
                                    ?>
                                    <option value="<?php echo $generoOption['id_genero']; ?>" <?php if ($generoOption['nombre'] == $row['Genero']) { echo 'selected'; }?>><?php echo $generoOption['nombre']; ?></option>
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
                            <input type="number" name="portada" id="administraciones" value="<?php echo $row['Portada']; ?>" required>
                        </div>
                        <div class="inputs">
                            <label for="trailer" class="textos5">Tráiler</label>
                            <br>
                            <input type="number" name="trailer" id="administraciones" value="<?php echo $row['Trailer']; ?>" required>
                        </div>
                        <div class="inputs">
                            <label for="video" class="textos5">Vídeo</label>
                            <br>
                            <input type="number" name="video" id="administraciones" value="<?php echo $row['Video']; ?>" required>
                        </div>
                        <div class="inputs">
                            <label for="logo" class="textos5">Logo</label>
                            <br>
                            <input type="number" name="logo" id="administraciones" value="<?php echo $row['Logo']; ?>" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-1" id="editarAdmin" name='actualizar' value='actualizar'>Actualizar</button>
                    </form>
                <?php
                ?>
                <?php
                    }
                    if (isset($_POST['actualizar'])) {
                        $id_pelicula = $_POST['id_pelicula'];
                        $pelicula = $_POST['pelicula'];
                        $descripcion = $_POST['descripcion'];
                        $ano = $_POST['ano'];
                        $genero = $_POST['genero'];
                        $edad = $_POST['edad'];
                        $portada = $_POST['portada'];
                        $trailer = $_POST['trailer'];
                        $video = $_POST['video'];
                        $logo = $_POST['logo'];
                        // Preparar la consulta SQL
                        $sqlInsertar = $conn->prepare('UPDATE peliculas SET nombre = :nombre, descripcion = :descripcion, ano = :ano, genero = :genero, edad = :edad, portada = :portada WHERE id_pelicula = :id_pelicula');
                        $sqlInsertar->bindParam(':id_pelicula', $id_pelicula);
                        $sqlInsertar->bindParam(':nombre',$nombre);
                        $sqlInsertar->bindParam(':descripcion',$descripcion);
                        $sqlInsertar->bindParam(':ano',$ano);
                        $sqlInsertar->bindParam(':genero',$genero);
                        $sqlInsertar->bindParam(':edad',$edad);
                        $sqlInsertar->bindParam(':portada',$portada);
                        // Ejecutar la consulta
                        $sqlInsertar->execute();
                        // Actualización exitosa
                        header('Location: ../administrar.php');
                        $sqlInsertar->closeCursor();
                        $conn = null;
                    }
                }
            }catch(Exception $e){
                echo "Error: ". $e->getMessage() ."";//si hay algun tipo de error lo muestra
            }
        ?>
    </div>
    </body>
</html>