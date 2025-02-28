<?php
try {
    session_start();
    // Verificar si el usuario está logueado
    if (isset($_SESSION['id_usuarios'])) {
        include_once("../conexion/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueVideo - Inicio</title>
    <link rel="stylesheet" href="index.css">
    <link rel="shortcut icon" href="../img/logo_bluevideo (1).png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    <script src="../js/buscador.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
    <aside class="background--banner">
        <?php
            $sql = "SELECT peliculas.id_pelicula AS IdPelicula, peliculas.nombre AS Pelicula, peliculas.descripcion AS Descripcion, peliculas.ano AS Ano,
                genero.nombre AS Genero, peliculas.portada AS Portada, peliculas.trailer AS Trailer, peliculas.pelicula AS Video,
                peliculas.logo AS Logo, directores.nombre_director AS Director, GROUP_CONCAT(DISTINCT actores.nombre_actor SEPARATOR ', ') AS Actor,
                COUNT(DISTINCT likes.id_likes) AS Likes FROM peliculas JOIN director_pelicula
                ON director_pelicula.id_pelicula = peliculas.id_pelicula JOIN directores ON directores.id_director = director_pelicula.id_director
                JOIN actor_pelicula ON actor_pelicula.id_pelicula = peliculas.id_pelicula JOIN actores
                ON actores.id_actor = actor_pelicula.id_actor JOIN genero ON genero.id_genero = peliculas.genero JOIN likes
                ON likes.id_pelicula = peliculas.id_pelicula AND likes.`like/dislike` = 1 GROUP BY peliculas.id_pelicula, peliculas.nombre,
                peliculas.descripcion, peliculas.ano, genero.nombre, peliculas.portada, peliculas.trailer, peliculas.pelicula,
                directores.nombre_director ORDER BY Likes DESC LIMIT 5;";
            $stmt1 = $conn->prepare($sql);
            $stmt1->execute();
            $peliculas = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <video id="backgroundVideo" muted autoplay loop poster="../video/sueños de fuga trailer.mp4">
            <source src="../video/sueños de fuga trailer.mp4" type="video/mp4">
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
                        <?php
                        $idUsuario = $_SESSION['id_usuarios'];
                        $query_admin = "SELECT rol FROM usuarios WHERE id_usuarios = :id_usuario";
                        $stmt = $conn->prepare($query_admin);
                        $stmt->bindParam(':id_usuario', $idUsuario);
                        $stmt->execute();
                        $usuario = $stmt->fetchColumn();

                        if ($usuario === 2) {
                            ?>
                            <li><a href="./administrar.php">Administración</a></li>;
                            <?php
                        }

                        ?>
                    </ul>
                    <ul class="navegacion navegacion--derecha">
                        <li><a href="../index.php">Cerrar sesión</a></li>
                    </ul>
                </nav>
            </div>                        

            <div class="buscador">
                <input type="text" id="buscadorPelicula" placeholder="Filtra por nombre de película">
                <input type="text" id="buscadorDirector" placeholder="Filtra por directores">
                <input type="text" id="buscadorActor" placeholder="Filtra por actores">
                <input type="text" id="buscadorGenero" placeholder="Filtra por géneros">
                <button id="filtrar-button" onclick="filtrarPeliculas()">Filtrar</button>
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
        <div id="contenido_normal">
            <section class="catalogo--peliculas">
                <h1>Top 5</h1>
                <div class="peliculas" id="populares">
                <?php
                    foreach ($peliculas as $pelicula) {
                    ?>
                    <article class="pelicula">
                        <a href="#" onclick="cambiarVideo('<?php echo $pelicula['Trailer']; ?>', '<?php echo $pelicula['Portada']; ?>', '<?php echo $pelicula['Logo']; ?>', '<?php echo $pelicula['Descripcion']; ?>', '<?php echo $pelicula['Genero']; ?>', '<?php echo $pelicula['Director']; ?>', '<?php echo $pelicula['Actor']; ?>', '<?php echo $pelicula['IdPelicula'] ?>')">
                            <img src="../img/<?php echo $pelicula['Portada']; ?>" alt="">
                        </a>
                    </article>
                    <?php
                        }
                    ?>
                </div>
            </section>

            <section class="catalogo--peliculas">
                <h2>Todas las películas</h2>
                <div class="peliculas" id="estreno">
                    <?php
                        $sql2 = "SELECT peliculas.id_pelicula AS IdPelicula, peliculas.nombre AS Pelicula, peliculas.descripcion AS Descripcion, peliculas.ano AS Ano,
                        genero.nombre AS Genero, peliculas.portada AS Portada, peliculas.trailer AS Trailer, peliculas.pelicula AS Video,
                        peliculas.logo AS Logo, directores.nombre_director AS Director, GROUP_CONCAT(actores.nombre_actor SEPARATOR ', ') AS Actor
                        FROM peliculas JOIN director_pelicula ON director_pelicula.id_pelicula = peliculas.id_pelicula JOIN directores ON
                        directores.id_director = director_pelicula.id_director JOIN actor_pelicula
                        ON actor_pelicula.id_pelicula = peliculas.id_pelicula JOIN actores ON actores.id_actor = actor_pelicula.id_actor
                        JOIN genero ON genero.id_genero = peliculas.genero
                        LEFT JOIN (
                            SELECT peliculas.id_pelicula FROM peliculas JOIN likes ON likes.id_pelicula = peliculas.id_pelicula
                            AND likes.`like/dislike` = 1 GROUP BY peliculas.id_pelicula ORDER BY COUNT(DISTINCT likes.id_likes) DESC
                            LIMIT 5
                        ) AS top_5 ON peliculas.id_pelicula = top_5.id_pelicula WHERE top_5.id_pelicula IS NULL
                        GROUP BY peliculas.id_pelicula, peliculas.nombre, peliculas.descripcion, peliculas.ano, genero.nombre,
                        peliculas.portada, peliculas.trailer, peliculas.pelicula, directores.nombre_director;";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->execute();
                        $peliculas2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($peliculas2 as $pelicula2) {
                    ?>
                    <article class="pelicula">
                        <a href="#" onclick="cambiarVideo('<?php echo $pelicula2['Trailer']; ?>', '<?php echo $pelicula2['Portada']; ?>', '<?php echo $pelicula2['Logo']; ?>', '<?php echo $pelicula2['Descripcion']; ?>', '<?php echo $pelicula2['Genero']; ?>', '<?php echo $pelicula2['Director']; ?>', '<?php echo $pelicula2['Actor']; ?>', '<?php echo $pelicula2['IdPelicula'] ?>')">
                            <img src="../img/<?php echo $pelicula2['Portada']; ?>" alt="">
                        </a>
                    </article>
                    <?php
                        }
                    ?>
                </div>
            </section>        

        </div>
            <!-- Mostramos los filtros usados -->
            <div class="filtros-aplicados" id="filtros_aplicados"></div>
            <!-- Mostramos las peliculas obtenidas del filtro -->
            <div class="peliculas" id="resultados_filtro"></div>
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
    } else {
        header("Location: ../login/login.php");
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>