<?php
try {
    session_start();
    if ($_SESSION["id_usuarios"]) {
        include_once("./conexion/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlueVideo - Administración</title>
    <link rel="stylesheet" href="./administracion.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="./img/logo_bluevideo (1).png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
</head>
<body style="background-color: #4E769E;"> 
    <?php
        $sqlRol = "SELECT id_rol, rol FROM roles;";
        $stmtRol = $conn->prepare($sqlRol);
        $stmtRol->execute();
        $roles = $stmtRol->fetchAll(PDO::FETCH_ASSOC);

        $sqlSuscripcion = "SELECT id_suscripcion, suscripcion FROM suscripciones;";
        $stmtSuscripcion = $conn->prepare($sqlSuscripcion);
        $stmtSuscripcion->execute();
        $suscripciones = $stmtSuscripcion->fetchAll(PDO::FETCH_ASSOC);

        $sqlGeneros = "SELECT id_genero, nombre FROM genero";
        // Preparación y ejecución de la consulta para obtener mesas
        $stmtGeneros = $conn->prepare($sqlGeneros);
        $stmtGeneros->execute();
        $generos = $stmtGeneros->fetchAll(PDO::FETCH_ASSOC);


    ?>
    <div class="banner">
        <div class="menu">
            <nav>
                <ul class="navegacion navegacion--izquierda">
                    <li class="logo"><a href="#"><img src="./img/texto_bluevideo (1).png" alt="BlueVideo" style="height: 35px; width: 250px;"></a></li>
                    <br>
                    <li><a href="./index.php">Inicio</a></li>
                    <li><a href="./generos.php">Géneros</a></li>
                    <li><a href="./administrar.php">Administración</a></li>
                </ul>
            </nav>
            <nav>
                <ul class="navegacion navegacion--derecha">
                    <li><a href="#"><img src="Multimedia/lupa.svg" alt="Lupa"></a></li>
                    <li class="usuario"><a href="#"><img src="Multimedia/user.png" alt="Usuario"></a></li>
                </ul>
            </nav>
        </div>
        <br>
        <div class="flex">
            <select name="admins" id="administraciones" class="admins">
                <option value="tab1" class="peliculasOption">Usuarios</option>
                <option value="tab2" class="peliculasOption">Peliculas</option>
                <option value="tab3" class="actoresOption">Actores</option>
                <option value="tab4" class="directoresOption">Directores</option>
                <option value="tab5" class="generosOption">Generos</option>
                <option value="tab6" class="rolesOption">Roles</option>
                <option value="tab7" class="suscripcionesOption">Suscripciones</option>
            </select>
        </div>
        
        <div id="tab1" class="tab-content Usuarios">
            <h1 id="titulo">Usuarios</h1>
            <div class="tablas">
                <header class="flex header">
                        <form action='' method='post'>
                            <label for="nombre" class="textos">Nombre de usuario:</label>
                            <input type="text" name="nombre" id="administraciones">

                            <label for="apellidos" class="textos" style="padding-left: 4px;">Apellidos:</label>
                            <input type="text" name="apellidos" id="administraciones">

                            <label for="email" class="textos" style="padding-left: 4px;">Correo:</label>
                            <input type="email" name="email" id="administraciones">

                            <label for="contrasena" class="textos" style="padding-left: 4px;">Contraseña:</label>
                            <input type="password" name="contrasena" id="administraciones">
                            <br><br>
                            <div class="flex">
                                <label for="rol" class="textos" style="padding-right: 4px;">Rol:</label>
                                <select name='rol' id="administraciones">
                                    <option value='Todas' name='Todas'>Todas</option>
                                    <?php
                                    //mostramos los roles de la bd que tenemos guardadas en el array
                                    foreach ($roles as $rolOption) {
                                        echo "<option name='".$rolOption['rol']."' value='".$rolOption['id_rol']."'>".$rolOption['rol']."</option>";
                                    }
                                    ?>
                                </select>
                                <label for="suscripcion" class="textos" style="padding-right: 4px; padding-left: 18px;">Suscripcion:</label>
                                <select name='suscripcion' id="administraciones">
                                    <option value='Todos' name='Todos'>Todos</option>
                                    <?php
                                    //mostramos las suscripciones de la bd que tenemos guardados en el array
                                    foreach ($suscripciones as $suscripcionOption) {
                                        echo "<option name='".$suscripcionOption['suscripcion']."' value='".$suscripcionOption['id_suscripcion']."'>".$suscripcionOption['suscripcion']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <br>
                            <div class="flex">
                                <button type='submit' name='añadir' value='añadir' id="administrar" class="btn btn-1">Añadir</button>
                            </div>
                        </form>
                </header>

                <?php
                    // Aplicar el filtrado si se hizo clic en el botón de filtrar
                    if (isset($_POST['añadir'])) {
                        $nombre = $_POST['nombre'];
                        $apellidos = $_POST['apellidos'];
                        $email = $_POST['email'];
                        $contrasena = $_POST['contrasena'];
                        $rol = $_POST['rol'];
                        $suscripcion = $_POST['suscripcion'];
                        $sqlInsertar = "INSERT INTO usuarios (nombre, apellidos, email, contrasena, rol, suscripcion) VALUES (:nombre, :apellidos, :email, :contrasena, :rol, :suscripcion)";
                        $stmtInsertar = $conn->prepare($sqlInsertar);
                        $stmtInsertar->bindParam(':nombre',$nombre);
                        $stmtInsertar->bindParam(':apellidos',$apellidos);
                        $stmtInsertar->bindParam(':email',$email);
                        $stmtInsertar->bindParam(':contrasena',$contrasena);
                        $stmtInsertar->bindParam(':rol',$rol);
                        $stmtInsertar->bindParam(':suscripcion',$suscripcion);
                        $stmtInsertar->execute();
                        ?>
                        <script>
                            Swal.fire({
                                icon: "success",
                                text: "Usuario añadido correctamente",
                                confirmButtonText: '<a href="./administrar.php" style="text-decoration:none; color:white;">OK</a>',
                            });
                        </script>
                        <?php
                    }
                try{
                    // Definir la consulta inicial para mostrar toda la tabla
                    $sqlMostrar = "SELECT id_usuarios AS id_usuarios, nombre AS Nombre, apellidos AS Apellidos, email AS Correo, contrasena AS Contraseña,
                    roles.rol AS Rol, suscripciones.suscripcion AS Suscripcion FROM usuarios LEFT JOIN roles ON usuarios.rol = roles.id_rol
                    LEFT JOIN suscripciones ON suscripciones.id_suscripcion = usuarios.suscripcion ORDER BY id_usuarios ASC";
                    $stmtMostrar = $conn->prepare($sqlMostrar);
                    $stmtMostrar->execute();
                    $resultado = $stmtMostrar->fetchAll(PDO::FETCH_ASSOC);

                    // Verificar si hay resultados
                        if ($resultado) {
                            echo "<table class='table mt-3 flex'>
                                    <tr>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>ID</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Nombre</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Apellidos</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Correo</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Contraseña</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Rol</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Suscripcion</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                    </tr>";

                            foreach ($resultado as $fila) {
                                echo "<tr>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila['id_usuarios']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila['Nombre']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila['Apellidos']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila['Correo']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila['Contraseña']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila['Rol']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila['Suscripcion']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px;'><a href='./proc/editarUsuarios.php?id_usuarios=" . $fila['id_usuarios'] . "'><button id='editar'>Editar</button></a></td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px; padding-right: 0px;'><a href='./proc/eliminarUsuarios.php?id_usuarios=" . $fila['id_usuarios'] . "'><button id='eliminar'>Eliminar</button></a></td>
                                    </tr>";
                            } 
                            echo "</table>";
                        } else {
                            echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                            
                        }
                        $stmtMostrar->closeCursor();
                }
                catch(Exception $e){
                    echo "Error: ". $e->getMessage() ."";//maneja excepciones
                }
                ?> 
            </div>
        </div>
        <div id="tab2" class="tab-content Películas">
            <h1 id="titulo">Películas</h1>
            <div class="tablas">
                <header class="flex header">
                        <form action='' method='post'>
                            <label for="pelicula" class="textos">Película:</label>
                            <input type="text" name="pelicula" id="administraciones">

                            <label for="descripcion" class="textos" style="padding-left: 4px;">Descripcion:</label>
                            <input type="text" name="descripcion" id="administraciones">

                            <label for="ano" class="textos" style="padding-left: 4px;">Año:</label>
                            <input type="number" name="ano" id="administraciones">

                            <label for="genero" class="textos" style="padding-left: 4px;">Género:</label>
                            <select name='genero' id="administraciones">
                                <?php
                                //mostramos las roles de la bd que tenemos guardadas en el array
                                foreach ($generos as $generoOption) {
                                    ?>
                                    <option value="<?php echo $generoOption['id_genero']; ?>"><?php echo $generoOption['nombre']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            
                            <br><br>
                            <div class="flex">
                                <label for="edad" class="textos" style="padding-right: 4px;">Edad:</label>
                                <input type="text" name="edad" id="administraciones">
                                <label for="portada" class="textos" style="padding-right: 4px; padding-left: 8px;">Portada:</label>
                                <input type="text" name="portada" id="administraciones">
                                <label for="trailer" class="textos" style="padding-right: 4px; padding-left: 8px;">Tráiler:</label>
                                <input type="text" name="trailer" id="administraciones">
                                <label for="video" class="textos" style="padding-right: 4px; padding-left: 8px;">Vídeo:</label>
                                <input type="text" name="video" id="administraciones">
                                <label for="logo" class="textos" style="padding-right: 4px; padding-left: 8px;">Logo:</label>
                                <input type="text" name="logo" id="administraciones">
                            </div>
                            <br>
                            <br>
                            <div class="flex">
                                <button type='submit' name='añadir2' value='añadir2' id="administrar" class="btn btn-1">Añadir</button>
                            </div>
                        </form>
                </header>

                <?php
                    // Aplicar el filtrado si se hizo clic en el botón de filtrar
                    if (isset($_POST['añadir2'])) {
                        $pelicula = $_POST['pelicula'];
                        $descripcion = $_POST['descripcion'];
                        $ano = $_POST['ano'];
                        $genero = $_POST['genero'];
                        $edad = $_POST['edad'];
                        $portada = $_POST['portada'];
                        $trailer = $_POST['trailer'];
                        $video = $_POST['video'];
                        $logo = $_POST['logo'];
                        $sqlInsertar2 = "INSERT INTO peliculas (nombre, descripcion, ano, genero, edad, portada, trailer, video, logo) VALUES (:pelicula, :descripcion, :ano, :genero, :edad, :portada, :trailer, :video, :logo)";
                        $stmtInsertar2 = $conn->prepare($sqlInsertar2);
                        $stmtInsertar2->bindParam(':pelicula',$pelicula);
                        $stmtInsertar2->bindParam(':descripcion',$descripcion);
                        $stmtInsertar2->bindParam(':ano',$ano);
                        $stmtInsertar2->bindParam(':genero',$genero);
                        $stmtInsertar2->bindParam(':edad',$edad);
                        $stmtInsertar2->bindParam(':portada',$portada);
                        $stmtInsertar2->bindParam(':trailer',$trailer);
                        $stmtInsertar2->bindParam(':video',$video);
                        $stmtInsertar2->bindParam(':logo',$logo);
                        $stmtInsertar2->execute();
                        ?>
                        <script>
                            Swal.fire({
                                icon: "success",
                                text: "Película añadida correctamente",
                                confirmButtonText: '<a href="./administrar.php" style="text-decoration:none; color:white;">OK</a>',
                            });
                        </script>
                        <?php
                    }
                try{
                    // Definir la consulta inicial para mostrar toda la tabla
                    $sqlMostrar2 = "SELECT id_pelicula AS id_pelicula, nombre AS Pelicula, descripcion AS Descripcion, ano AS Año, genero AS Genero,
                    edad AS Edad, portada AS Portada, trailer AS Trailer, pelicula AS Video, logo AS Logo FROM peliculas ORDER BY id_pelicula ASC";
                    $stmtMostrar2 = $conn->prepare($sqlMostrar2);
                    $stmtMostrar2->execute();
                    $resultado2 = $stmtMostrar2->fetchAll(PDO::FETCH_ASSOC);

                    // Verificar si hay resultados
                        if ($resultado2) {
                            echo "<table class='table mt-3 flex'>
                                    <tr>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>ID</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Película</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Descripción</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Año</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Género</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Edad</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Portada</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Tráiler</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Vídeo</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Logo</th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                        <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                    </tr>";

                            foreach ($resultado2 as $fila2) {
                                echo "<tr>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['id_pelicula']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['Pelicula']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['Descripcion']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['Año']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['Genero']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['Edad']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['Portada']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['Trailer']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['Video']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila2['Logo']."</td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px;'><a href='./proc/editarPeliculas.php?id_pelicula=" . $fila2['id_pelicula'] . "'><button id='editar'>Editar</button></a></td>
                                        <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px; padding-right: 0px;'><a href='./proc/eliminarPeliculas.php?id_pelicula=" . $fila2['id_pelicula'] . "'><button id='eliminar'>Eliminar</button></a></td>
                                    </tr>";
                            } 
                            echo "</table>";
                        } else {
                            echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                            
                        }
                        $stmtMostrar2->closeCursor();
                }
                catch(Exception $e){
                    echo "Error: ". $e->getMessage() ."";//maneja excepciones
                }
                ?> 
            </div>
        </div>
        <div id="tab3" class="tab-content actoresRelaciones">
            <div class="Actores">
                <h1 id="titulo">Actores</h1>
                <div class="tablas">
                    <header class="flex header">
                            <form action='' method='post'>
                                <label for="actor" class="textos">Actor:</label>
                                <input type="text" name="actor" id="administraciones">
                                <br><br>
                                <div class="flex">
                                    <button type='submit' name='añadir3' value='añadir3' id="administrar" class="btn btn-1">Añadir</button>
                                </div>
                            </form>
                    </header>

                    <?php
                        // Aplicar el filtrado si se hizo clic en el botón de filtrar
                        if (isset($_POST['añadir3'])) {
                            $actor = $_POST['actor'];
                            $sqlInsertar4 = "INSERT INTO actores (nombre_actor) VALUES (:actor)";
                            $stmtInsertar4 = $conn->prepare($sqlInsertar4);
                            $stmtInsertar4->bindParam(':actor',$actor);
                            $stmtInsertar4->execute();
                            ?>
                            <script>
                                Swal.fire({
                                    icon: "success",
                                    text: "Película añadida correctamente",
                                    confirmButtonText: '<a href="./administrar.php" style="text-decoration:none; color:white;">OK</a>',
                                });
                            </script>
                            <?php
                        }
                    try{
                        // Definir la consulta inicial para mostrar toda la tabla
                        $sqlMostrar4 = "SELECT id_actor AS id_actor, nombre_actor AS Nombre FROM actores";
                        $stmtMostrar4 = $conn->prepare($sqlMostrar4);
                        $stmtMostrar4->execute();
                        $resultado4 = $stmtMostrar4->fetchAll(PDO::FETCH_ASSOC);

                        // Verificar si hay resultados
                            if ($resultado4) {
                                echo "<table class='table mt-3 flex'>
                                        <tr>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>ID</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Director</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                        </tr>";

                                foreach ($resultado4 as $fila4) {
                                    echo "<tr>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila4['id_actor']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila4['Nombre']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px;'><a href='./proc/editarUsuarios.php?id_actor=" . $fila4['id_actor'] . "'><button id='editar'>Editar</button></a></td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px; padding-right: 0px;'><a href='./proc/eliminarUsuarios.php?id_actor=" . $fila4['id_actor'] . "'><button id='eliminar'>Eliminar</button></a></td>
                                        </tr>";
                                } 
                                echo "</table>";
                            } else {
                                echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";   
                            }
                            $stmtMostrar4->closeCursor();
                    }
                    catch(Exception $e){
                        echo "Error: ". $e->getMessage() ."";//maneja excepciones
                    }
                    ?> 
            </div>
            </div>
            <div class="ActoresPeliculas">
                <h1 id="titulo">Actor | Película</h1>
                <div class="tablas">
                    <header class="flex header">
                            <form action='' method='post'>
                                <label for="actor" class="textos">Actor:</label>
                                <input type="text" name="actor" id="administraciones">

                                <label for="pelicula" class="textos">Película:</label>
                                <input type="text" name="pelicula" id="administraciones">
                                <br><br>
                                <div class="flex">
                                    <button type='submit' name='añadir4' value='añadir4' id="administrar" class="btn btn-1">Añadir</button>
                                </div>
                            </form>
                    </header>

                    <?php
                        // Aplicar el filtrado si se hizo clic en el botón de filtrar
                        if (isset($_POST['añadir4'])) {
                            $actor = $_POST['actor'];
                            $pelicula = $_POST['pelicula'];
                            $sqlInsertar6 = "INSERT INTO actor_pelicula (id_actor, id_pelicula) VALUES (:id_actor, :id_pelicula)";
                            $stmtInsertar6 = $conn->prepare($sqlInsertar6);
                            $stmtInsertar6->bindParam(':id_actor',$actor);
                            $stmtInsertar5->bindParam(':id_pelicula',$pelicula);
                            $stmtInsertar6->execute();
                        }
                    try{
                        // Definir la consulta inicial para mostrar toda la tabla
                        $sqlMostrar6 = "SELECT actor_pelicula.id_actor_pelicula AS id_actor_pelicula, actores.nombre_actor AS Actor, peliculas.nombre AS Pelicula FROM actor_pelicula LEFT JOIN actores ON actores.id_actor = actor_pelicula.id_actor LEFT JOIN peliculas ON peliculas.id_pelicula = actor_pelicula.id_pelicula";
                        $stmtMostrar6 = $conn->prepare($sqlMostrar6);
                        $stmtMostrar6->execute();
                        $resultado6 = $stmtMostrar6->fetchAll(PDO::FETCH_ASSOC);

                        // Verificar si hay resultados
                            if ($resultado6) {
                                echo "<table class='table mt-3 flex'>
                                        <tr>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>ID</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Actor</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Pelicula</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                        </tr>";

                                foreach ($resultado6 as $fila6) {
                                    echo "<tr>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila6['id_actor_pelicula']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila6['Actor']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila6['Pelicula']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px;'><a href='./proc/editarUsuarios.php?id_actor_pelicula=" . $fila6['id_actor_pelicula'] . "'><button id='editar'>Editar</button></a></td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px; padding-right: 0px;'><a href='./proc/eliminarUsuarios.php?id_actor_pelicula=" . $fila6['id_actor_pelicula'] . "'><button id='eliminar'>Eliminar</button></a></td>
                                        </tr>";
                                } 
                                echo "</table>";
                            } else {
                                echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                                
                            }
                            $stmtMostrar6->closeCursor();
                    }
                    catch(Exception $e){
                        echo "Error: ". $e->getMessage() ."";//maneja excepciones
                    }
                    ?> 
                </div>
            </div>
        </div>
        <div id="tab4" class="tab-content directoresRelaciones">
            <div class="Directores">
                <h1 id="titulo">Directores</h1>
                <div class="tablas">
                    <header class="flex header">
                            <form action='' method='post'>
                                <label for="director" class="textos">Director:</label>
                                <input type="text" name="director" id="administraciones">
                                <br><br>
                                <div class="flex">
                                    <button type='submit' name='añadir5' value='añadir5' id="administrar" class="btn btn-1">Añadir</button>
                                </div>
                            </form>
                    </header>

                    <?php
                        // Aplicar el filtrado si se hizo clic en el botón de filtrar
                        if (isset($_POST['añadir5'])) {
                            $director = $_POST['director'];
                            $sqlInsertar3 = "INSERT INTO directores (nombre_director) VALUES (:director)";
                            $stmtInsertar3 = $conn->prepare($sqlInsertar3);
                            $stmtInsertar3->bindParam(':director',$director);
                            $stmtInsertar3->execute();
                        }
                    try{
                        // Definir la consulta inicial para mostrar toda la tabla
                        $sqlMostrar3 = "SELECT id_director AS id_director, nombre_director AS Nombre FROM directores";
                        $stmtMostrar3 = $conn->prepare($sqlMostrar3);
                        $stmtMostrar3->execute();
                        $resultado3 = $stmtMostrar3->fetchAll(PDO::FETCH_ASSOC);

                        // Verificar si hay resultados
                            if ($resultado3) {
                                echo "<table class='table mt-3 flex'>
                                        <tr>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>ID</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Director</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                        </tr>";

                                foreach ($resultado3 as $fila3) {
                                    echo "<tr>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila3['id_director']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila3['Nombre']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px;'><a href='./proc/editarUsuarios.php?id_director=" . $fila3['id_director'] . "'><button id='editar'>Editar</button></a></td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px; padding-right: 0px;'><a href='./proc/eliminarUsuarios.php?id_director=" . $fila3['id_director'] . "'><button id='eliminar'>Eliminar</button></a></td>
                                        </tr>";
                                } 
                                echo "</table>";
                            } else {
                                echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                                
                            }
                            $stmtMostrar3->closeCursor();
                    }
                    catch(Exception $e){
                        echo "Error: ". $e->getMessage() ."";//maneja excepciones
                    }
                    ?> 
                </div>
            </div>
            <div class="DirectoresPeliculas">
            <h1 id="titulo">Director | Película</h1>
                <div class="tablas">
                    <header class="flex header">
                            <form action='' method='post'>
                                <label for="director" class="textos">Director:</label>
                                <input type="text" name="director" id="administraciones">

                                <label for="pelicula" class="textos">Película:</label>
                                <input type="text" name="pelicula" id="administraciones">

                                <br><br>
                                <div class="flex">
                                    <button type='submit' name='añadir6' value='añadir6' id="administrar" class="btn btn-1">Añadir</button>
                                </div>
                            </form>
                    </header>

                    <?php
                        // Aplicar el filtrado si se hizo clic en el botón de filtrar
                        if (isset($_POST['añadir6'])) {
                            $director = $_POST['director'];
                            $pelicula = $_POST['pelicula'];
                            $sqlInsertar5 = "INSERT INTO director_pelicula (id_director, id_pelicula) VALUES (:id_director, :id_pelicula)";
                            $stmtInsertar5 = $conn->prepare($sqlInsertar5);
                            $stmtInsertar5->bindParam(':id_director',$director);
                            $stmtInsertar5->bindParam(':id_pelicula',$pelicula);
                            $stmtInsertar5->execute();
                        }
                    try{
                        // Definir la consulta inicial para mostrar toda la tabla
                        $sqlMostrar5 = "SELECT director_pelicula.id_director_pelicula AS id_director_pelicula, directores.nombre_director AS Director, peliculas.nombre AS Pelicula FROM director_pelicula LEFT JOIN directores ON directores.id_director = director_pelicula.id_director LEFT JOIN peliculas ON peliculas.id_pelicula = director_pelicula.id_pelicula";
                        $stmtMostrar5 = $conn->prepare($sqlMostrar5);
                        $stmtMostrar5->execute();
                        $resultado5 = $stmtMostrar5->fetchAll(PDO::FETCH_ASSOC);

                        // Verificar si hay resultados
                            if ($resultado5) {
                                echo "<table class='table mt-3 flex'>
                                        <tr>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>ID</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Director</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Pelicula</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                        </tr>";

                                foreach ($resultado5 as $fila5) {
                                    echo "<tr>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila5['id_director_pelicula']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila5['Director']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila5['Pelicula']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px;'><a href='./proc/editarUsuarios.php?id_usuarios=" . $fila5['id_director_pelicula'] . "'><button id='editar'>Editar</button></a></td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px; padding-right: 0px;'><a href='./proc/eliminarUsuarios.php?id_usuarios=" . $fila5['id_director_pelicula'] . "'><button id='eliminar'>Eliminar</button></a></td>
                                        </tr>";
                                } 
                                echo "</table>";
                            } else {
                                echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                                
                            }
                            $stmtMostrar5->closeCursor();
                    }
                    catch(Exception $e){
                        echo "Error: ". $e->getMessage() ."";//maneja excepciones
                    }
                    ?> 
                </div>
            </div>    
        </div>
        <div id="tab5" class="tab-content Generos">
            <h1 id="titulo">Generos</h1>
                <div class="tablas">
                    <header class="flex header">
                            <form action='' method='post'>
                                <label for="director" class="textos">Actor:</label>
                                <input type="text" name="director" id="administraciones">
                                <br><br>
                                <div class="flex">
                                    <button type='submit' name='añadir7' value='añadir7' id="administrar" class="btn btn-1">Añadir</button>
                                </div>
                            </form>
                    </header>

                    <?php
                        // Aplicar el filtrado si se hizo clic en el botón de filtrar
                        if (isset($_POST['añadir7'])) {
                            $genero = $_POST['genero'];
                            $sqlInsertar7 = "INSERT INTO genero (nombre) VALUES (:genero)";
                            $stmtInsertar7 = $conn->prepare($sqlInsertar7);
                            $stmtInsertar7->bindParam(':genero',$genero);
                            $stmtInsertar7->execute();
                        }
                    try{
                        // Definir la consulta inicial para mostrar toda la tabla
                        $sqlMostrar7 = "SELECT id_genero AS id_genero, nombre AS Genero FROM genero";
                        $stmtMostrar7 = $conn->prepare($sqlMostrar7);
                        $stmtMostrar7->execute();
                        $resultado7 = $stmtMostrar7->fetchAll(PDO::FETCH_ASSOC);

                        // Verificar si hay resultados
                            if ($resultado7) {
                                echo "<table class='table mt-3 flex'>
                                        <tr>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>ID</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Genero</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                        </tr>";

                                foreach ($resultado7 as $fila7) {
                                    echo "<tr>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila7['id_genero']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila7['Genero']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px;'><a href='./proc/editarUsuarios.php?id_genero=" . $fila7['id_genero'] . "'><button id='editar'>Editar</button></a></td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px; padding-right: 0px;'><a href='./proc/eliminarUsuarios.php?id_genero=" . $fila7['id_genero'] . "'><button id='eliminar'>Eliminar</button></a></td>
                                        </tr>";
                                } 
                                echo "</table>";
                            } else {
                                echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";   
                            }
                            $stmtMostrar7->closeCursor();
                    }
                    catch(Exception $e){
                        echo "Error: ". $e->getMessage() ."";//maneja excepciones
                    }
                    ?> 
                </div>
        </div>
        <div id="tab6" class="tab-content Roles">
            <h1 id="titulo">Roles</h1>
                <div class="tablas">
                    <header class="flex header">
                            <form action='' method='post'>
                                <label for="rol" class="textos">Rol:</label>
                                <input type="text" name="rol" id="administraciones">
                                <br><br>
                                <div class="flex">
                                    <button type='submit' name='añadir8' value='añadir8' id="administrar" class="btn btn-1">Añadir</button>
                                </div>
                            </form>
                    </header>

                    <?php
                        // Aplicar el filtrado si se hizo clic en el botón de filtrar
                        if (isset($_POST['añadir8'])) {
                            $rol = $_POST['rol'];
                            $sqlInsertar8 = "INSERT INTO roles (rol) VALUES (:rol)";
                            $stmtInsertar8 = $conn->prepare($sqlInsertar8);
                            $stmtInsertar8->bindParam(':rol',$rol);
                            $stmtInsertar8->execute();
                        }
                    try{
                        // Definir la consulta inicial para mostrar toda la tabla
                        $sqlMostrar8 = "SELECT id_rol AS id_rol, rol AS Rol FROM roles";
                        $stmtMostrar8 = $conn->prepare($sqlMostrar8);
                        $stmtMostrar8->execute();
                        $resultado8 = $stmtMostrar8->fetchAll(PDO::FETCH_ASSOC);

                        // Verificar si hay resultados
                            if ($resultado8) {
                                echo "<table class='table mt-3 flex'>
                                        <tr>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>ID</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Rol</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                        </tr>";

                                foreach ($resultado8 as $fila8) {
                                    echo "<tr>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila8['id_rol']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila8['Rol']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px;'><a href='./proc/editarUsuarios.php?id_rol=" . $fila8['id_rol'] . "'><button id='editar'>Editar</button></a></td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px; padding-right: 0px;'><a href='./proc/eliminarUsuarios.php?id_rol=" . $fila8['id_rol'] . "'><button id='eliminar'>Eliminar</button></a></td>
                                        </tr>";
                                } 
                                echo "</table>";
                            } else {
                                echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";   
                            }
                            $stmtMostrar8->closeCursor();
                    }
                    catch(Exception $e){
                        echo "Error: ". $e->getMessage() ."";//maneja excepciones
                    }
                    ?> 
                </div>
        </div>
        <div id="tab7" class="tab-content Suscripciones">
            <h1 id="titulo">Suscripciones</h1>
                <div class="tablas">
                    <header class="flex header">
                            <form action='' method='post'>
                                <label for="suscripcion" class="textos">Suscripcion:</label>
                                <input type="text" name="suscripcion" id="administraciones">

                                <label for="precio" class="textos">Precio:</label>
                                <input type="number" name="precio" id="administraciones">

                                <label for="dispositivos" class="textos">Dispositivos:</label>
                                <input type="number" name="dispositivos" id="administraciones">

                                <label for="calidad" class="textos">Calidad:</label>
                                <input type="text" name="calidad" id="administraciones">
                                <br><br>
                                <div class="flex">
                                    <button type='submit' name='añadir9' value='añadir9' id="administrar" class="btn btn-1">Añadir</button>
                                </div>
                            </form>
                    </header>

                    <?php
                        // Aplicar el filtrado si se hizo clic en el botón de filtrar
                        if (isset($_POST['añadir9'])) {
                            $suscripcion = $_POST['suscripcion'];
                            $sqlInsertar9 = "INSERT INTO suscripciones (suscripcion) VALUES (:suscripcion)";
                            $stmtInsertar9 = $conn->prepare($sqlInsertar9);
                            $stmtInsertar9->bindParam(':suscripcion',$suscripcion);
                            $stmtInsertar9->execute();
                        }
                    try{
                        // Definir la consulta inicial para mostrar toda la tabla
                        $sqlMostrar9 = "SELECT id_suscripcion AS id_suscripcion, suscripcion AS Suscripcion, precio AS Precio, dispositivos AS Dispositivos, calidad AS Calidad FROM suscripciones";
                        $stmtMostrar9 = $conn->prepare($sqlMostrar9);
                        $stmtMostrar9->execute();
                        $resultado9 = $stmtMostrar9->fetchAll(PDO::FETCH_ASSOC);

                        // Verificar si hay resultados
                            if ($resultado9) {
                                echo "<table class='table mt-3 flex'>
                                        <tr>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>ID</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Suscripcion</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Precio</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Dispositivos</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'>Calidad</th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                            <th style='border-top-width: 2px; border-top: 2px solid #1A426A; border-bottom: 2px solid #1A426A;'></th>
                                        </tr>";

                                foreach ($resultado9 as $fila9) {
                                    echo "<tr>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila9['id_suscripcion']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila9['Suscripcion']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila9['Precio']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila9['Dispositivos']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A;'>".$fila9['Calidad']."</td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px;'><a href='./proc/editarUsuarios.php?id_suscripcion=" . $fila9['id_suscripcion'] . "'><button id='editar'>Editar</button></a></td>
                                            <td style='border-top-width: 2px; border-bottom: 2px solid #1A426A; padding-left: 0px; padding-right: 0px;'><a href='./proc/eliminarUsuarios.php?id_suscripcion=" . $fila9['id_suscripcion'] . "'><button id='eliminar'>Eliminar</button></a></td>
                                        </tr>";
                                } 
                                echo "</table>";
                            } else {
                                echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";   
                            }
                            $stmtMostrar9->closeCursor();
                    }
                    catch(Exception $e){
                        echo "Error: ". $e->getMessage() ."";//maneja excepciones
                    }
                    ?> 
                </div>
        </div>
    </div>
    <script>
        opcion = $;
        opcion(document).ready(function () {

            // Se queda con la pestaña seleccionada, sinó muestra la primera
            var activeTab = localStorage.getItem('activeTab') || 'tab1';

            // Abre la pestaña activa
            openTab(activeTab);

            // Función para cambiar de pestaña
            function openTab(tabName) {

                // Oculta todas las pestañas
                opcion('.tab-content').hide();

                // Si es 'tab3' o 'tab4', te lo muestra con flex (en vez de 'block')
                if (tabName === 'tab3' || tabName === 'tab4') {
                    opcion('#' + tabName).css('display', 'flex');
                }else{
                    opcion('#' + tabName).show();   // Muestra la pestaña seleccionada  
                }

                // Mantiene la última tabla seleccionada abierta
                localStorage.setItem('activeTab', tabName);
            }

            // Se queda mostrada la opción seleccionada
            opcion('#administraciones').change(function () {
                var selectedTab = opcion(this).val();
                openTab(selectedTab);
            });
            
        });
    </script>
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