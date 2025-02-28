<?php
try {
    session_start();
    if ($_SESSION["id_usuarios"]) {
        include_once("../conexion/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueVideo - Inicio</title>
    <!-- <link rel="stylesheet" href="normalize.css"> -->
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="../img/logo_bluevideo (1).png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <aside class="background--banner">
        <?php
            $sql = "SELECT peliculas.id_pelicula AS IdPelicula, peliculas.nombre AS Pelicula, peliculas.descripcion AS Descripcion, peliculas.ano AS Ano,
            genero.nombre AS Genero, peliculas.portada AS Portada, peliculas.trailer AS Trailer, peliculas.pelicula AS Video, peliculas.logo AS Logo,
            directores.nombre_director AS Director, GROUP_CONCAT(DISTINCT actores.nombre_actor SEPARATOR ', ') AS Actor FROM peliculas JOIN director_pelicula
            ON director_pelicula.id_pelicula = peliculas.id_pelicula JOIN directores ON directores.id_director = director_pelicula.id_director
            JOIN actor_pelicula ON actor_pelicula.id_pelicula = peliculas.id_pelicula JOIN actores ON actores.id_actor = actor_pelicula.id_actor
            JOIN genero ON genero.id_genero = peliculas.genero WHERE peliculas.genero = 1 GROUP BY peliculas.id_pelicula, peliculas.nombre,
            peliculas.descripcion, peliculas.ano, genero.nombre, peliculas.portada, peliculas.trailer, peliculas.pelicula, directores.nombre_director;";
            $stmt1 = $conn->prepare($sql);
            $stmt1->execute();
            $peliculas = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <video id="backgroundVideo" muted autoplay loop poster="./video/sueños de fuga trailer.mp4">
            <source src="./video/sueños de fuga trailer.mp4" type="video/mp4">
            <img id="backgroundImage" src="../img/sueno_de_fuga.jpg" alt="Imagen de fondo">
        </video>
        <div class="banner">
            <div class="menu">
                <nav>
                    <ul class="navegacion navegacion--izquierda">
                        <li class="logo"><a href="#"><img src="../img/texto_bluevideo (1).png" alt="BlueVideo" style="height: 35px; width: 250px;"></a></li>
                        <br>
                        <li><a href="./index.php">Inicio</a></li>
                        <li><a href="./generos.php">Géneros</a></li>
                        <li><a href="./administrar.php">Administración</a></li>
                    </ul>
                </nav>
            </div>
            <div class="imagotipo">
                <div class="imagotipo--imagen" style="width: 60%;">
                    <img id="logoImage" src="../img/logo_sueno_de_fuga.jpg" alt="Logo película" style="width:50%;">
                </div>
                <div class="detalles">
                    <p id="detallesText">Dos hombres encarcelados entablan una amistad a lo largo de los años, encontrando consuelo y redención eventual a través de actos de decencia común.</p>
                    <br>
                    <div class="masdetalles">
                       <p id="generoText">Drama</p>
                       <i class="bi bi-dot"></i>
                       <p id="directorText">Frank Darabont</p>
                       <i class="bi bi-dot"></i>
                       <p id="actoresText">Tim Robbins, Morgan Freeman, Matt Damon</p>
                    </div>
                </div>
                <div class="imagotipo--info">
                    <p>⏵Ver</p>
                    <br>
                    <!-- Like -->
                    <div class="like-container" pelicula-id="<?php if (isset($pelicula['IdPelicula'])) { echo $pelicula['IdPelicula']; } else {} ?>" usuario-id="<?php echo $_SESSION["id_usuarios"]; ?>" accion="like">
                        <a href="#" class="like-button" onmouseover="mostrarLikeBlanco(this)" onmouseout="ocultarLikeBlanco(this)" onclick="darLike('like')">
                            <img src="../img/like.jpg" alt="">
                        </a>
                        <a href="#" class="like-blanco-button" style="display: none;">
                            <img src="../img/like_blanco.jpg" alt="">
                        </a>
                    </div>
                    
                    <!-- Dislike -->
                    <div class="dislike-container" pelicula-id="<?php if (isset($pelicula['IdPelicula'])) { echo $pelicula['IdPelicula']; } else {} ?>" usuario-id="<?php echo $_SESSION["id_usuarios"]; ?>" accion="dislike">
                        <a href="#" class="dislike-button" onmouseover="mostrarDislikeBlanco(this)" onmouseout="ocultarDislikeBlanco(this)" onclick="darDislike('dislike')">
                            <img src="../img/dislike.jpg" alt="">
                        </a>
                        <a href="#" class="dislike-blanco-button" style="display: none;">
                            <img src="../img/dislike_blanco.png" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </aside>
    <main class="catalogos">
        <section id="generos" class="catalogo--peliculas">
            <h1>Drama</h1>
            <div class="peliculas" id="populares">
                <?php
                    foreach ($peliculas as $pelicula) {
                ?>
                <article class="pelicula">
                    <a href="<?php echo $pelicula['Pelicula']; ?>" onclick="cambiarVideo('<?php echo $pelicula['Trailer']; ?>', '<?php echo $pelicula['Portada']; ?>', '<?php echo $pelicula['Logo']; ?>', '<?php echo $pelicula['Descripcion']; ?>', '<?php echo $pelicula['Genero']; ?>', '<?php echo $pelicula['Director']; ?>', '<?php echo $pelicula['Actor']; ?>', '<?php echo $pelicula['IdPelicula'] ?>')">
                        <img src="../img/<?php echo $pelicula['Portada']; ?>" alt="">
                    </a>
                </article>
                <?php
                    }
                ?>
            </div>
        </section>
    
        <section id="generos" class="catalogo--peliculas">
            <h2>Thriller</h2>
            <div class="peliculas" id="estreno">
                <?php
                    $sql2 = "SELECT peliculas.id_pelicula AS IdPelicula, peliculas.nombre AS Pelicula, peliculas.descripcion AS Descripcion, peliculas.ano AS Ano,
                    genero.nombre AS Genero, peliculas.portada AS Portada, peliculas.trailer AS Trailer, peliculas.pelicula AS Video, peliculas.logo AS Logo,
                    directores.nombre_director AS Director, GROUP_CONCAT(actores.nombre_actor SEPARATOR ', ') AS Actor FROM peliculas JOIN director_pelicula
                    ON director_pelicula.id_pelicula = peliculas.id_pelicula JOIN directores ON directores.id_director = director_pelicula.id_director
                    JOIN actor_pelicula ON actor_pelicula.id_pelicula = peliculas.id_pelicula JOIN actores ON actores.id_actor = actor_pelicula.id_actor
                    JOIN genero ON genero.id_genero = peliculas.genero WHERE peliculas.genero = 6 GROUP BY peliculas.id_pelicula, peliculas.nombre,
                    peliculas.descripcion, peliculas.ano, genero.nombre, peliculas.portada, peliculas.trailer, peliculas.pelicula, directores.nombre_director;";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->execute();
                    $peliculas2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($peliculas2 as $pelicula2) {
                ?>
                <article class="pelicula">
                    <a href="<?php echo $pelicula2['Pelicula']; ?>" onclick="cambiarVideo('<?php echo $pelicula2['Trailer']; ?>', '<?php echo $pelicula2['Portada']; ?>', '<?php echo $pelicula2['Logo']; ?>', '<?php echo $pelicula2['Descripcion']; ?>', '<?php echo $pelicula2['Genero']; ?>', '<?php echo $pelicula2['Director']; ?>', '<?php echo $pelicula2['Actor']; ?>', '<?php echo $pelicula2['IdPelicula'] ?>')">
                        <img src="../img/<?php echo $pelicula2['Portada']; ?>" alt="">
                    </a>
                </article>
                <?php
                    }
                ?>
            </div>
        </section>
        <section id="generos" class="catalogo--peliculas">
            <h2>Acción</h2>
            <div class="peliculas" id="vistas">
                <?php
                    $sql3 = "SELECT peliculas.id_pelicula AS IdPelicula, peliculas.nombre AS Pelicula, peliculas.descripcion AS Descripcion, peliculas.ano AS Ano,
                    genero.nombre AS Genero, peliculas.portada AS Portada, peliculas.trailer AS Trailer, peliculas.pelicula AS Video, peliculas.logo AS Logo,
                    directores.nombre_director AS Director, GROUP_CONCAT(actores.nombre_actor SEPARATOR ', ') AS Actor FROM peliculas JOIN director_pelicula
                    ON director_pelicula.id_pelicula = peliculas.id_pelicula JOIN directores ON directores.id_director = director_pelicula.id_director
                    JOIN actor_pelicula ON actor_pelicula.id_pelicula = peliculas.id_pelicula JOIN actores ON actores.id_actor = actor_pelicula.id_actor
                    JOIN genero ON genero.id_genero = peliculas.genero WHERE peliculas.genero = 3 GROUP BY peliculas.id_pelicula, peliculas.nombre,
                    peliculas.descripcion, peliculas.ano, genero.nombre, peliculas.portada, peliculas.trailer, peliculas.pelicula, directores.nombre_director;";
                    $stmt3 = $conn->prepare($sql3);
                    $stmt3->execute();
                    $peliculas3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($peliculas3 as $pelicula3) {
                ?>
                <article class="pelicula">
                    <a href="<?php echo $pelicula3['Pelicula']; ?>" onclick="cambiarVideo('<?php echo $pelicula3['Trailer']; ?>', '<?php echo $pelicula3['Portada']; ?>', '<?php echo $pelicula3['Logo']; ?>', '<?php echo $pelicula3['Descripcion']; ?>', '<?php echo $pelicula3['Genero']; ?>', '<?php echo $pelicula3['Director']; ?>', '<?php echo $pelicula3['Actor']; ?>', '<?php echo $pelicula3['IdPelicula'] ?>')">
                        <img src="../img/<?php echo $pelicula3['Portada']; ?>" alt="">
                    </a>
                </article>
                <?php
                    }
                ?>
            </div>
        </section>
        <section id="generos" class="catalogo--peliculas">
            <h2>Más generos</h2>
            <div class="peliculas" id="vistas">
                <?php
                    $sql4 = "SELECT peliculas.id_pelicula AS IdPelicula, peliculas.nombre AS Pelicula, peliculas.descripcion AS Descripcion, peliculas.ano AS Ano,
                    genero.nombre AS Genero, peliculas.portada AS Portada, peliculas.trailer AS Trailer, peliculas.pelicula AS Video, peliculas.logo AS Logo,
                    directores.nombre_director AS Director, GROUP_CONCAT(actores.nombre_actor SEPARATOR ', ') AS Actor FROM peliculas JOIN director_pelicula
                    ON director_pelicula.id_pelicula = peliculas.id_pelicula JOIN directores ON directores.id_director = director_pelicula.id_director
                    JOIN actor_pelicula ON actor_pelicula.id_pelicula = peliculas.id_pelicula JOIN actores ON actores.id_actor = actor_pelicula.id_actor
                    JOIN genero ON genero.id_genero = peliculas.genero WHERE peliculas.genero IN (2, 5, 8) GROUP BY peliculas.id_pelicula, peliculas.nombre,
                    peliculas.descripcion, peliculas.ano, genero.nombre, peliculas.portada, peliculas.trailer, peliculas.pelicula, directores.nombre_director;";
                    $stmt4 = $conn->prepare($sql4);
                    $stmt4->execute();
                    $peliculas4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($peliculas4 as $pelicula4) {
                ?>
                <article class="pelicula">
                    <a href="<?php echo $pelicula4['Pelicula']; ?>" onclick="cambiarVideo('<?php echo $pelicula4['Trailer']; ?>', '<?php echo $pelicula4['Portada']; ?>', '<?php echo $pelicula4['Logo']; ?>', '<?php echo $pelicula4['Descripcion']; ?>', '<?php echo $pelicula4['Genero']; ?>', '<?php echo $pelicula4['Director']; ?>', '<?php echo $pelicula4['Actor']; ?>', '<?php echo $pelicula4['IdPelicula'] ?>')">
                        <img src="../img/<?php echo $pelicula4['Portada']; ?>" alt="">
                    </a>
                </article>
                <?php
                    }
                ?>
            </div>
        </section>
    </main>
    <footer class="footer">
        <div class="footer--contenedor">
            <ul class="iconos">
                <li><a href="#"><img src="../Multimedia/facebook.svg" alt="facebook"></a></li>
                <li><a href="#"><img src="../Multimedia/instagram.svg" alt="instagram"></a></li>
                <li><a href="#"><img src="../Multimedia/github.svg" alt="github"></a></li>
                <li><a href="#"><img src="../Multimedia/linkedin.svg" alt="linkedin"></a></li>
            </ul>
            <div class="informacion">
                <p>Preguntas frecuentes</p>
                <p>Prensa</p>
                <p>Formas de ver</p>
                <p>Preferencias de cookies</p>
                <p>Pruebas de velocidad</p>
                <p>Centro de ayuda</p>
                <p>Relaciones con inversionistas</p>
                <p>Terminos de uso</p>
                <p>Informacion corporativa</p>
                <p>Cuenta</p>
                <p>Empleo</p>
                <p>Privacidad</p>
                <p>Contactanos</p>
                <p>Solo en bluevideo</p>
            </div>
            <p class="idioma">🌎︎ Español</p>
            <p class="contruccion"></p>
        </div>
    </footer>
    <script src="./js/index.js"></script>
</body>
</html>
<?php
    }else {
        header("Location: ./login/login.php");
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>