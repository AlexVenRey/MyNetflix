<?php
include_once("../conexion/conexion.php");

$nombre_pelicula = isset($_POST['pelicula']) ? trim($_POST['pelicula']) : '';
$director = isset($_POST['director']) ? trim($_POST['director']) : '';
$actor = isset($_POST['actor']) ? trim($_POST['actor']) : '';
$genero = isset($_POST['genero']) ? trim($_POST['genero']) : '';

$sql = "SELECT peliculas.id_pelicula AS IdPelicula, peliculas.nombre AS Pelicula, peliculas.descripcion AS Descripcion,
        peliculas.ano AS Ano, genero.nombre AS Genero, peliculas.portada AS Portada, peliculas.trailer AS Trailer,
        peliculas.pelicula AS Video, peliculas.logo AS Logo, directores.nombre_director AS Director,
        GROUP_CONCAT(DISTINCT actores.nombre_actor SEPARATOR ', ') AS Actor
        FROM peliculas
        JOIN director_pelicula ON director_pelicula.id_pelicula = peliculas.id_pelicula
        JOIN directores ON directores.id_director = director_pelicula.id_director
        JOIN actor_pelicula ON actor_pelicula.id_pelicula = peliculas.id_pelicula
        JOIN actores ON actores.id_actor = actor_pelicula.id_actor
        JOIN genero ON genero.id_genero = peliculas.genero
        WHERE 1=1";

if (!empty($nombre_pelicula)) {
    $sql .= " AND peliculas.nombre LIKE :nombre_pelicula";
}
if (!empty($director)) {
    $sql .= " AND directores.nombre_director LIKE :director";
}
if (!empty($actor)) {
    $sql .= " AND actores.nombre_actor LIKE :actor";
}
if (!empty($genero)) {
    $sql .= " AND genero.nombre LIKE :genero";
}

$sql .= " GROUP BY peliculas.id_pelicula";

$stmt = $conn->prepare($sql);

// Vincula los parámetros solo si tienen valor
if (!empty($nombre_pelicula)) {
    $stmt->bindValue(':nombre_pelicula', "%$nombre_pelicula%", PDO::PARAM_STR);
}
if (!empty($director)) {
    $stmt->bindValue(':director', "%$director%", PDO::PARAM_STR);
}
if (!empty($actor)) {
    $stmt->bindValue(':actor', "%$actor%", PDO::PARAM_STR);
}
if (!empty($genero)) {
    $stmt->bindValue(':genero', "%$genero%", PDO::PARAM_STR);
}

$stmt->execute();
$peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($peliculas): ?>
    <div class="peliculas_filtro_contenedor">
        <?php foreach ($peliculas as $pelicula): ?>
            <article class="pelicula_filtro">  
                <a href="#" onclick="cambiarVideo('<?= $pelicula['Trailer'] ?>', '<?= $pelicula['Portada'] ?>', '<?= $pelicula['Logo'] ?>', '<?= $pelicula['Descripcion'] ?>', '<?= $pelicula['Genero'] ?>', '<?= $pelicula['Director'] ?>', '<?= $pelicula['Actor'] ?>', '<?= $pelicula['IdPelicula'] ?>')">
                    <img src="../img/<?= htmlspecialchars($pelicula['Portada']) ?>" alt="<?= htmlspecialchars($pelicula['Pelicula']) ?>">
                </a>
            </article>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No se encontraron películas con esos filtros.</p>
<?php endif; ?>
