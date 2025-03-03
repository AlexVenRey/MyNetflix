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
    <title>BlueVideo - Administración</title>
    <link rel="stylesheet" href="./administracion.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../img/logo_bluevideo (1).png" type="image/x-icon">
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

        $sqlGeneros = "SELECT id_genero, nombre FROM genero";
        $stmtGeneros = $conn->prepare($sqlGeneros);
        $stmtGeneros->execute();
        $generos = $stmtGeneros->fetchAll(PDO::FETCH_ASSOC);

        $sqlActores = "SELECT id_actor, nombre_actor FROM actores";
        $stmtActores = $conn->prepare($sqlActores);
        $stmtActores->execute();
        $actores = $stmtActores->fetchAll(PDO::FETCH_ASSOC);

        $sqlDirectores = "SELECT id_director, nombre_director FROM directores";
        $stmtDirectores = $conn->prepare($sqlDirectores);
        $stmtDirectores->execute();
        $directores = $stmtDirectores->fetchAll(PDO::FETCH_ASSOC);

        $sqlPeliculas = "SELECT id_pelicula, nombre FROM peliculas";
        $stmtPeliculas = $conn->prepare($sqlPeliculas);
        $stmtPeliculas->execute();
        $peliculas = $stmtPeliculas->fetchAll(PDO::FETCH_ASSOC);

    ?>
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
        <br>
        <div class="flex">
            <select name="admins" id="administraciones" class="admins" style="width: 9%;">
                <option value="tab1" class="usuariosOption">Usuarios</option>
                <option value="tab2" class="peliculasOption">Peliculas</option>
                <option value="tab3" class="actoresOption">Actores</option>
                <option value="tab4" class="directoresOption">Directores</option>
                <option value="tab5" class="generosOption">Generos</option>
                <option value="tab6" class="rolesOption">Roles</option>
                <option value="tab7" class="activarOption">Activar Usuarios</option>
            </select>
        </div>
        
        <div id="tab1" class="tab-content Usuarios">
            <h1 id="titulo">Usuarios</h1>
            <div class="tablas">
                <header class="flex header">
                        <form action='' method='POST'>
                            <label for="nombre" class="textos">Nombre de usuario:</label>
                            <input type="text" name="nombre" id="administraciones" value="<?php if(isset($_POST['nombre'])) {echo $_POST['nombre'];} ?>">

                            <label for="apellidos" class="textos" style="padding-left: 4px;">Apellidos:</label>
                            <input type="text" name="apellidos" id="administraciones" value="<?php if(isset($_POST['apellidos'])) {echo $_POST['apellidos'];} ?>">
                            <br><br>

                            <label for="email" class="textos" style="padding-left: 4px;">Correo:</label>
                            <input type="email" name="email" id="administraciones" value="<?php if(isset($_POST['email'])) {echo $_POST['email'];} ?>">

                            <label for="contrasena" class="textos" style="padding-left: 4px;">Contraseña:</label>
                            <input type="password" name="contrasena" id="administraciones" value="<?php if(isset($_POST['contrasena'])) {echo $_POST['contrasena'];} ?>">
                            <br><br>
                            <div class="flex">
                                <label for="rol" class="textos" style="padding-right: 4px;">Rol:</label>
                                <select name='rol' id="administraciones">
                                    <option value='Todas' name='Todas'>Todos</option>
                                    <?php

                                    foreach ($roles as $rolOption) {

                                        $rolSeleccionado = (isset($_POST['rol']) && $_POST['rol'] == $rolOption['id_rol']) ? 'selected' : '';
                                        echo "<option name='".$rolOption['rol']."' value='".  $rolOption['id_rol'] ."' $rolSeleccionado>".$rolOption['rol']."</option>";

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
                    // Aplicar el filtrado si se hizo clic en el botón de añadir
                    if (isset($_POST['añadir'])) {

                        $nombre = trim($_POST['nombre']);
                        $apellidos = trim($_POST['apellidos']);
                        $email = trim($_POST['email']);
                        $contrasena = trim($_POST['contrasena']);
                        $rol = $_POST['rol'];
                    
                        // Validación: verificar si hay campos vacíos
                        if (empty($nombre) || empty($apellidos) || empty($email) || empty($contrasena) || empty($rol)) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'Todos los campos son obligatorios',
                                        confirmButtonText: 'OK'
                                    });
                                  </script>";
                        } 
                        // Validación: verificar formato de correo
                        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'El correo electrónico no es válido',
                                        confirmButtonText: 'OK'
                                    });
                                  </script>";
                        } 
                        // Validación: verificar que la contraseña tenga al menos 6 caracteres
                        elseif (strlen($contrasena) < 6) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'La contraseña debe tener al menos 6 caracteres',
                                        confirmButtonText: 'OK'
                                    });
                                  </script>";
                        } 
                        // Validación: verificar que el rol sea válido (por seguridad, puedes verificar si el rol existe en la BD)
                        elseif (!is_numeric($rol)) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'Seleccione un rol válido',
                                        confirmButtonText: 'OK'
                                    });
                                  </script>";
                        } 
                        // Si todas las validaciones pasan, insertar el usuario en la BD
                        else {
                            try {
                                $sqlInsertar = "INSERT INTO usuarios (nombre, apellidos, email, contrasena, rol) VALUES (:nombre, :apellidos, :email, :contrasena, :rol)";
                                $stmtInsertar = $conn->prepare($sqlInsertar);
                                $stmtInsertar->bindParam(':nombre', $nombre);
                                $stmtInsertar->bindParam(':apellidos', $apellidos);
                                $stmtInsertar->bindParam(':email', $email);
                                $stmtInsertar->bindParam(':contrasena', $contrasena);
                                $stmtInsertar->bindParam(':rol', $rol);
                                $stmtInsertar->execute();
                    
                                echo "<script>
                                        Swal.fire({
                                            icon: 'success',
                                            text: 'Usuario añadido correctamente',
                                            confirmButtonText: '<a href=\"./administrar.php\" style=\"text-decoration:none; color:white;\">OK</a>',
                                        });
                                      </script>";
                            } catch (Exception $e) {
                                echo "<script>
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Error al registrar usuario: " . $e->getMessage() . "',
                                            confirmButtonText: 'OK'
                                        });
                                      </script>";
                            }
                        }
                    }
                try{
                    // Definir la consulta inicial para mostrar toda la tabla
                    $sqlMostrar = "SELECT id_usuarios AS id_usuarios, nombre AS Nombre, apellidos AS Apellidos, email AS Correo, contrasena AS Contraseña,
                    roles.rol AS Rol FROM usuarios LEFT JOIN roles ON usuarios.rol = roles.id_rol ORDER BY id_usuarios ASC";
                    $stmtMostrar = $conn->prepare($sqlMostrar);
                    $stmtMostrar->execute();
                    $resultado = $stmtMostrar->fetchAll(PDO::FETCH_ASSOC);

                    // Verificar si hay resultados
                        if ($resultado) {

                            echo "<table class='table mt-3 flex'>
                            <tr>
                                <th class='estilosTh'>ID</th>
                                <th class='estilosTh'>Nombre</th>
                                <th class='estilosTh'>Apellidos</th>
                                <th class='estilosTh'>Correo</th>
                                <th class='estilosTh'>Contraseña</th>
                                <th class='estilosTh'>Rol</th>
                                <th class='estilosTh'></th>
                                <th class='estilosTh'></th>
                            </tr>";

                            foreach ($resultado as $fila) {

                                $contraseña = ($fila['Contraseña'] != null && $fila['Contraseña'] != '') ? "········" : "No hay contraseña";
                                echo "<tr>
                                    <td class='estilosTd'>".$fila['id_usuarios']."</td>
                                    <td class='estilosTd'>".$fila['Nombre']."</td>
                                    <td class='estilosTd'>".$fila['Apellidos']."</td>
                                    <td class='estilosTd'>".$fila['Correo']."</td>
                                    <td class='estilosTd'>".$contraseña."</td>
                                    <td class='estilosTd'>".$fila['Rol']."</td>
                                    <td class='estilosTd2'><a href='./proc/editarUsuarios.php?id_usuarios=" . $fila['id_usuarios'] . "'><button id='editar'>Editar</button></a></td>
                                    <td class='estilosTd3'>
                                        <button id='eliminar' class='btnEliminarUsuarios' data-usuario-id='". $fila['id_usuarios'] ."' >Eliminar</button>
                                    </td>
                                </tr>";
                            } 
                            echo "</table>";
                        } else {
                            echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                            
                        }
                        $stmtMostrar->closeCursor();
                }
                catch(Exception $e){
                    echo "Error: ". $e->getMessage() ."";
                }
                ?> 
            </div>
        </div>
        <div id="tab2" class="tab-content Películas">
            <h1 id="titulo">Películas</h1>
            <div class="tablas">
                <header class="flex header">
                    <form action='' method='POST' enctype="multipart/form-data">
                            
                        <label for="pelicula" class="textos">Película:</label>
                        <input type="text" name="pelicula" id="administraciones" value="<?php if(isset($_POST['pelicula'])) {echo $_POST['pelicula'];} ?>">

                        <label for="descripcion" class="textos" style="padding-left: 4px;">Descripcion:</label>
                        <input type="text" name="descripcion" id="administraciones" value="<?php if(isset($_POST['descripcion'])) {echo $_POST['descripcion'];} ?>">

                        <label for="ano" class="textos" style="padding-left: 4px;">Año:</label>
                        <input type="number" name="ano" id="administraciones" value="<?php if(isset($_POST['ano'])) {echo $_POST['ano'];} ?>">

                        <label for="genero" class="textos" style="padding-left: 4px;">Género:</label>
                        <select name='genero' id="administraciones">
                            <?php

                            foreach ($generos as $generoOption) {
                                $generoSeleccionado = (isset($_POST['genero']) && $_POST['genero'] == $generoOption['id_genero']) ? 'selected' : '';
                                ?>
                                <option value="<?php echo $generoOption['id_genero']; ?>" <?php echo $generoSeleccionado; ?> ><?php echo $generoOption['nombre']; ?></option>
                                <?php
                            }

                            ?>
                        </select>
                        <label for="edad" class="textos" style="padding-left: 4px;">Edad:</label>
                        <input type="number" name="edad" id="administraciones" value="<?php if(isset($_POST['edad'])) {echo $_POST['edad'];} ?>">
                        
                        <br><br>

                        <div class="flex">
                            <label for="portada" class="textos" style="padding-right: 4px; padding-left: 8px;">Portada:</label>
                            <input type="file" name="portada" style="color:white;" value="<?php if(isset($_POST['portada'])) {echo $_POST['portada'];} ?>">
                            <label for="logo" class="textos" style="padding-right: 4px; padding-left: 8px;">Logo:</label>
                            <input type="file" style="color:white;" name="logo" value="<?php if(isset($_POST['logo'])) {echo $_POST['logo'];} ?>">
                            <label for="trailer" class="textos" style="padding-right: 4px; padding-left: 8px;">Tráiler:</label>
                            <input type="text" name="trailer" id="administraciones" value="<?php if(isset($_POST['trailer'])) {echo $_POST['trailer'];} ?>">
                            <label for="video" class="textos" style="padding-right: 4px; padding-left: 8px;">Vídeo:</label>
                            <input type="text" name="video" id="administraciones" value="<?php if(isset($_POST['video'])) {echo $_POST['video'];} ?>">
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
                        $portada = "";
                        $logo = "";

                        if (!empty($_FILES['portada']['name'])) {

                            $portada_subida = "../img/" . basename($_FILES['portada']['name']);
                            
                            if (move_uploaded_file($_FILES['portada']['tmp_name'], $portada_subida)) {
                                $portada = $portada_subida;
                            }
                    
                        }

                        $trailer = $_POST['trailer'];
                        $video = $_POST['video'];
                        
                        if (!empty($_FILES['logo']['name'])) {

                            $logo_subido = "../img/" . basename($_FILES['logo']['name']);
                            
                            if (move_uploaded_file($_FILES['logo']['tmp_name'], $logo_subido)) {
                                $logo = $logo_subido;
                            }
                    
                        }
                        
                        // Validación: verificar si hay campos vacíos
                        if (empty($pelicula) || empty($descripcion) || empty($ano) || empty($genero) || empty($edad) || empty($trailer) || empty($video)) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'Todos los campos son obligatorios',
                                        confirmButtonText: 'OK'
                                    });
                                  </script>";
                        } 
                        // Validación: verificar si el año es un número válido
                        elseif (!is_numeric($ano) || $ano < 1900 || $ano > date("Y")) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'El año debe ser un número válido entre 1900 y el año actual',
                                        confirmButtonText: 'OK'
                                    });
                                  </script>";
                        }
                        // Validación: verificar si la edad es un número válido
                        elseif (!is_numeric($edad)) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'La edad debe ser un número válido',
                                        confirmButtonText: 'OK'
                                    });
                                  </script>";
                        }
                        // Si todas las validaciones pasan, insertar la película en la BD
                        else {
                            try {
                                $sqlInsertar2 = "INSERT INTO peliculas (nombre, descripcion, ano, genero, edad, portada, trailer, pelicula, logo) 
                                                VALUES (:pelicula, :descripcion, :ano, :genero, :edad, :portada, :trailer, :video, :logo)";
                                $stmtInsertar2 = $conn->prepare($sqlInsertar2);
                                $stmtInsertar2->bindParam(':pelicula', $pelicula);
                                $stmtInsertar2->bindParam(':descripcion', $descripcion);
                                $stmtInsertar2->bindParam(':ano', $ano);
                                $stmtInsertar2->bindParam(':genero', $genero);
                                $stmtInsertar2->bindParam(':edad', $edad);
                                $stmtInsertar2->bindParam(':portada', $portada);
                                $stmtInsertar2->bindParam(':trailer', $trailer);
                                $stmtInsertar2->bindParam(':video', $video);
                                $stmtInsertar2->bindParam(':logo', $logo);
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
                            } catch (Exception $e) {
                                echo "<script>
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Error al añadir la película: " . $e->getMessage() . "',
                                            confirmButtonText: 'OK'
                                        });
                                      </script>";
                            }
                        }
                    }
                try{
                    // Definir la consulta inicial para mostrar toda la tabla
                    $sqlMostrar2 = "SELECT id_pelicula AS id_pelicula, peliculas.nombre AS Pelicula, descripcion AS Descripcion, ano AS Año,
                    edad AS Edad, portada AS Portada, logo AS Logo, genero.nombre AS Genero
                    FROM peliculas INNER JOIN genero ON genero.id_genero = peliculas.genero ORDER BY id_pelicula ASC";
                    $stmtMostrar2 = $conn->prepare($sqlMostrar2);
                    $stmtMostrar2->execute();
                    $resultado2 = $stmtMostrar2->fetchAll(PDO::FETCH_ASSOC);

                    if ($resultado2) {
                        echo "<table class='table mt-3 flex'>
                                <tr>
                                    <th class='estilosTh'>ID</th>
                                    <th class='estilosTh'>Película</th>
                                    <th class='estilosTh'>Descripción</th>
                                    <th class='estilosTh'>Año</th>
                                    <th class='estilosTh'>Género</th>
                                    <th class='estilosTh'>Edad</th>
                                    <th class='estilosTh'>Portada</th>
                                    <th class='estilosTh'>Logo</th>
                                    <th class='estilosTh'></th>
                                    <th class='estilosTh'></th>
                                </tr>";

                                foreach ($resultado2 as $fila2) {

                                    echo "<tr>
                                    <td class='estilosTd'>".$fila2['id_pelicula']."</td>
                                    <td class='estilosTd'>".$fila2['Pelicula']."</td>
                                    <td class='estilosTd'>".$fila2['Descripcion']."</td>
                                    <td class='estilosTd'>".$fila2['Año']."</td>
                                    <td class='estilosTd'>".$fila2['Genero']."</td>
                                    <td class='estilosTd'>".$fila2['Edad']."</td>
                                    <td class='estilosTd'>";
                                    
                                    if ($fila2['Portada'] === "" || $fila2['Portada'] === NULL) {

                                        echo "<p style='color:white; font-weight: 800;'>No tiene portada</p>";

                                    } elseif (file_exists("../img/" . $fila2['Portada'])) {

                                        echo "<img style='width: 50%;' src='../img/" . htmlspecialchars($fila2['Portada']) . "'>";

                                    } else {

                                        echo "<p style='color:white; font-weight: 800;'>" . htmlspecialchars($fila2['Portada']) . "</p>";

                                    }
                                    
                                    echo "</td>
                                    <td class='estilosTd'>";
                                    
                                    if ($fila2['Logo'] === "" || $fila2['Logo'] === NULL) {

                                        echo "<p style='color:white; font-weight: 800;'>No tiene portada</p>";

                                    } elseif (file_exists("../img/" . $fila2['Logo'])) {

                                        echo "<img style='width: 50%;' src='../img/" . htmlspecialchars($fila2['Logo']) . "'>";

                                    } else {

                                        echo "<p style='color:white; font-weight: 800;'>" . htmlspecialchars($fila2['Logo']) . "</p>";

                                    }

                                    echo "</td>
                                    <td class='estilosTd2'>
                                            <a href='./proc/editarPeliculas.php?id_pelicula=".$fila2['id_pelicula']."'><button id='editar'>Editar</button></a>
                                        </td>
                                        <td class='estilosTd3'>
                                            <button id='eliminar' class='btnEliminarPelicula' data-pelicula-id=".$fila2['id_pelicula'].">Eliminar</button>
                                        </td>
                                    </tr>";
                                    
                                }
                                
                        echo "</table>";

                    } else {

                        echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                        
                    }
                    $stmtMostrar2->closeCursor();
                }
                catch(Exception $e){

                    echo "Error: ". $e->getMessage() ."";

                }
                ?> 
            </div>
        </div>
        <div id="tab3" class="tab-content actoresRelaciones">
            <div class="Actores">
                <h1 id="titulo">Actores</h1>
                <div class="tablas">
                    <header class="flex header">
                        <form action='' method='POST'>
                            <label for="actor" class="textos">Actor:</label>
                            <input type="text" name="actor" id="administraciones" value="<?php if(isset($_POST['actor'])) {echo $_POST['actor'];} ?>">
                            <br><br>
                            <div class="flex">
                                <button type='submit' name='añadir3' value='añadir3' id="administrar" class="btn btn-1">Añadir</button>
                            </div>
                        </form>
                    </header>

                    <?php

                    if (isset($_POST['añadir3'])) {

                        $actor = trim($_POST['actor']);

                        if (empty($actor)) {
                            echo "<script>
                            Swal.fire({
                                icon: 'error',
                                text: 'El campo actor no puede estar vacío',
                                confirmButtonText: 'OK'
                            });
                            </script>";
                        } else {
                            try {
                                $sqlInsertar4 = "INSERT INTO actores (nombre_actor) VALUES (:actor)";
                                $stmtInsertar4 = $conn->prepare($sqlInsertar4);
                                $stmtInsertar4->bindParam(':actor', $actor);
                                $stmtInsertar4->execute();

                                echo "<script>
                                        Swal.fire({
                                            icon: 'success',
                                            text: 'Actor añadido correctamente',
                                            confirmButtonText: '<a href=\"./administrar.php\" style=\"text-decoration:none; color:white;\">OK</a>',
                                        });
                                    </script>";
                            } catch (Exception $e) {
                                echo "<script>
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Error al añadir el actor: " . $e->getMessage() . "',
                                            confirmButtonText: 'OK'
                                        });
                                    </script>";
                            }
                        }
                    }

                    try {
                        // Mostrar actores
                        $sqlMostrar4 = "SELECT id_actor, nombre_actor FROM actores";
                        $stmtMostrar4 = $conn->prepare($sqlMostrar4);
                        $stmtMostrar4->execute();
                        $resultado4 = $stmtMostrar4->fetchAll(PDO::FETCH_ASSOC);

                        if ($resultado4) {
                            echo "<table class='table mt-3 flex'>
                                    <tr>
                                        <th class='estilosTh'>ID</th>
                                        <th class='estilosTh'>Actor</th>
                                        <th class='estilosTh'></th>
                                        <th class='estilosTh'></th>
                                    </tr>";

                            foreach ($resultado4 as $fila4) {
                                echo "<tr>
                                        <td class='estilosTd'>".$fila4['id_actor']."</td>
                                        <td class='estilosTd'>".$fila4['nombre_actor']."</td>
                                        <td class='estilosTd'><a href='./proc/editarActor.php?id_actor=".$fila4['id_actor']."'><button id='editar'>Editar</button></a></td>
                                        <td class='estilosTd'>
                                            <button id='eliminar' class='btnEliminarActor' data-actor-id=".$fila4['id_actor'].">Eliminar</button>
                                        </td>
                                    </tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                        }
                        $stmtMostrar4->closeCursor();
                    } catch (Exception $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </div>
            </div>
            <div class="ActoresPeliculas">
                <h1 id="titulo">Actor | Película</h1>
                <div class="tablas">
                    <header class="flex header">
                        <form action='' method='POST'>
                            <label for="actor" class="textos">Actor:</label>
                            <select name='actorRelacion' id="administraciones">
                                <option value='Todas' name='Todas'>Todos</option>
                                <?php

                                foreach ($actores as $actorOption) {
                                    $actorSeleccionado = (isset($_POST['actorRelacion']) && $_POST['actorRelacion'] == $actorOption['id_actor']) ? 'selected' : '';
                                    echo "<option name='".$actorOption['nombre_actor']."' value='".  $actorOption['id_actor'] ."' $actorSeleccionado>".$actorOption['nombre_actor']."</option>";
                                }

                                ?>
                            </select>
                            <label for="pelicula" class="textos">Película:</label>
                            <select name='pelicula' id="administraciones">
                                <option value='Todas' name='Todas'>Todos</option>
                                <?php
                                //mostramos los roles de la bd que tenemos guardadas en el array
                                foreach ($peliculas as $peliculaOption) {
                                    $peliculaSeleccionada = (isset($_POST['pelicula']) && $_POST['pelicula'] == $peliculaOption['id_pelicula']) ? 'selected' : '';
                                    echo "<option name='".$peliculaOption['nombre']."' value='".  $peliculaOption['id_pelicula'] ."' $peliculaSeleccionada>".$peliculaOption['nombre']."</option>";
                                }
                                ?>
                            </select>
                            <br><br>
                            <div class="flex">
                                <button type='submit' name='añadir4' value='añadir4' id="administrar" class="btn btn-1">Añadir</button>
                            </div>
                        </form>
                    </header>

                    <?php
                    if (isset($_POST['añadir4'])) {

                        $actor = trim($_POST['actorRelacion']);
                        $pelicula = trim($_POST['pelicula']);

                        // Validaciones
                        if (empty($actor) || empty($pelicula)) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'Ambos campos (Actor y Película) son obligatorios',
                                        confirmButtonText: 'OK'
                                    });
                                </script>";
                        } elseif (!is_numeric($actor) || !is_numeric($pelicula)) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'Seleccione un Actor y una Película válidos',
                                        confirmButtonText: 'OK'
                                    });
                                </script>";
                        } else {
                            try {
                                $sqlInsertar6 = "INSERT INTO actor_pelicula (id_actor, id_pelicula) VALUES (:id_actor, :id_pelicula)";
                                $stmtInsertar6 = $conn->prepare($sqlInsertar6);
                                $stmtInsertar6->bindParam(':id_actor', $actor);
                                $stmtInsertar6->bindParam(':id_pelicula', $pelicula);
                                $stmtInsertar6->execute();

                                echo "<script>
                                        Swal.fire({
                                            icon: 'success',
                                            text: 'Relación Actor-Película añadida correctamente',
                                            confirmButtonText: '<a href=\"./administrar.php\" style=\"text-decoration:none; color:white;\">OK</a>',
                                        });
                                    </script>";
                            } catch (Exception $e) {
                                echo "<script>
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Error al añadir la relación: " . $e->getMessage() . "',
                                            confirmButtonText: 'OK'
                                        });
                                    </script>";
                            }
                        }
                    }

                        try {
                            // Mostrar relaciones actor - película
                            $sqlMostrar6 = "SELECT actor_pelicula.id_actor_pelicula, actores.nombre_actor AS Actor, peliculas.nombre AS Pelicula
                            FROM actor_pelicula
                            LEFT JOIN actores ON actores.id_actor = actor_pelicula.id_actor
                            LEFT JOIN peliculas ON peliculas.id_pelicula = actor_pelicula.id_pelicula";
                            $stmtMostrar6 = $conn->prepare($sqlMostrar6);
                            $stmtMostrar6->execute();
                            $resultado6 = $stmtMostrar6->fetchAll(PDO::FETCH_ASSOC);

                            if ($resultado6) {
                                echo "<table class='table mt-3 flex'>
                                        <tr>
                                            <th class='estilosTh'>ID</th>
                                            <th class='estilosTh'>Actor</th>
                                            <th class='estilosTh'>Pelicula</th>
                                            <th class='estilosTh'></th>
                                            <th class='estilosTh'></th>
                                        </tr>";

                                foreach ($resultado6 as $fila6) {
                                    echo "<tr>
                                            <td class='estilosTd'>".$fila6['id_actor_pelicula']."</td>
                                            <td class='estilosTd'>".$fila6['Actor']."</td>
                                            <td class='estilosTd'>".$fila6['Pelicula']."</td>
                                            <td class='estilosTd'><a href='./proc/editarActorPelicula.php?id_actor_pelicula=".$fila6['id_actor_pelicula']."'><button id='editar'>Editar</button></a></td>
                                            <td class='estilosTd'>
                                                <button id='eliminar' class='btnEliminarActorPelicula' data-actor-pelicula-id='".$fila6['id_actor_pelicula']."'>Eliminar</button>
                                            </td>
                                        </tr>";
                                }
                                echo "</table>";
                                
                            } else {
                                echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                            }
                            $stmtMostrar6->closeCursor();
                        } catch (Exception $e) {
                            echo "Error: " . $e->getMessage();
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
                            <input type="text" name="director" id="administraciones" value="<?php if(isset($_POST['director'])) {echo $_POST['director'];} ?>">
                            <br><br>
                            <div class="flex">
                                <button type='submit' name='añadir5' value='añadir5' id="administrar" class="btn btn-1">Añadir</button>
                            </div>
                        </form>
                    </header>

                    <?php

                    if (isset($_POST['añadir5'])) {
                        $director = trim($_POST['director']);

                        // Validaciones
                        if (empty($director)) {

                            echo "<script>
                            Swal.fire({
                                icon: 'error',
                                text: 'El campo Director no puede estar vacío',
                                confirmButtonText: 'OK'
                            });
                            </script>";

                        } else {

                            try {
                                $sqlInsertar3 = "INSERT INTO directores (nombre_director) VALUES (:director)";
                                $stmtInsertar3 = $conn->prepare($sqlInsertar3);
                                $stmtInsertar3->bindParam(':director', $director);
                                $stmtInsertar3->execute();

                                echo "<script>
                                        Swal.fire({
                                            icon: 'success',
                                            text: 'Director añadido correctamente',
                                            confirmButtonText: '<a href=\"./administrar.php\" style=\"text-decoration:none; color:white;\">OK</a>',
                                        });
                                    </script>";
                            } catch (Exception $e) {
                                echo "<script>
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Error al añadir el director: " . $e->getMessage() . "',
                                            confirmButtonText: 'OK'
                                        });
                                    </script>";
                            }
                            
                        }
                    }

                    try {
                        $sqlMostrar3 = "SELECT id_director AS id_director, nombre_director AS Nombre FROM directores";
                        $stmtMostrar3 = $conn->prepare($sqlMostrar3);
                        $stmtMostrar3->execute();
                        $resultado3 = $stmtMostrar3->fetchAll(PDO::FETCH_ASSOC);

                        if ($resultado3) {
                            echo "<table class='table mt-3 flex'>
                                    <tr>
                                        <th class='estilosTh'>ID</th>
                                        <th class='estilosTh'>Director</th>
                                        <th class='estilosTh'></th>
                                        <th class='estilosTh'></th>
                                    </tr>";

                            foreach ($resultado3 as $fila3) {
                                echo "<tr>
                                        <td class='estilosTd'>".$fila3['id_director']."</td>
                                        <td class='estilosTd'>".$fila3['Nombre']."</td>
                                        <td class='estilosTd'><a href='./proc/editarDirectores.php?id_director=" . $fila3['id_director'] . "'><button id='editar'>Editar</button></a></td>
                                        <td class='estilosTd'>
                                            <button id='eliminar' class='btnEliminarDirector' data-director-id='".$fila3['id_director']."'>Eliminar</button>
                                        </td>
                                    </tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                        }
                        $stmtMostrar3->closeCursor();
                    } catch(Exception $e) {
                        echo "Error: ". $e->getMessage();
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
                            <select name='directorRelacion' id="administraciones">
                                <option value='Todas' name='Todas'>Todos</option>
                                <?php
                                foreach ($directores as $directorOption) {
                                    $directorSeleccionado = (isset($_POST['directorRelacion']) && $_POST['directorRelacion'] == $directorOption['id_director']) ? 'selected' : '';
                                    echo "<option name='".$directorOption['nombre_director']."' value='".  $directorOption['id_director'] ."' $directorSeleccionado>".$directorOption['nombre_director']."</option>";
                                }
                                ?>
                            </select>

                            <label for="pelicula" class="textos">Película:</label>
                            <select name='pelicula' id="administraciones">
                                <option value='Todas' name='Todas'>Todos</option>
                                <?php
                                foreach ($peliculas as $peliculaOption) {
                                    $peliculaSeleccionada = (isset($_POST['pelicula']) && $_POST['pelicula'] == $peliculaOption['id_pelicula']) ? 'selected' : '';
                                    echo "<option name='".$peliculaOption['nombre']."' value='".  $peliculaOption['id_pelicula'] ."' $peliculaSeleccionada>".$peliculaOption['nombre']."</option>";
                                }
                                ?>
                            </select>

                            <br><br>
                            <div class="flex">
                                <button type='submit' name='añadir6' value='añadir6' id="administrar" class="btn btn-1">Añadir</button>
                            </div>
                        </form>
                    </header>

                    <?php

                    if (isset($_POST['añadir6'])) {

                        $director = trim($_POST['directorRelacion']);
                        $pelicula = trim($_POST['pelicula']);

                        // Validaciones
                        if (empty($director) || empty($pelicula)) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'Ambos campos (Director y Película) son obligatorios',
                                        confirmButtonText: 'OK'
                                    });
                                </script>";
                        } elseif (!is_numeric($director) || !is_numeric($pelicula)) {
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        text: 'Seleccione un Director y una Película válidos',
                                        confirmButtonText: 'OK'
                                    });
                                </script>";
                        } else {
                            try {
                                $sqlInsertar5 = "INSERT INTO director_pelicula (id_director, id_pelicula) VALUES (:id_director, :id_pelicula)";
                                $stmtInsertar5 = $conn->prepare($sqlInsertar5);
                                $stmtInsertar5->bindParam(':id_director', $director);
                                $stmtInsertar5->bindParam(':id_pelicula', $pelicula);
                                $stmtInsertar5->execute();

                                echo "<script>
                                        Swal.fire({
                                            icon: 'success',
                                            text: 'Relación Director-Película añadida correctamente',
                                            confirmButtonText: '<a href=\"./administrar.php\" style=\"text-decoration:none; color:white;\">OK</a>',
                                        });
                                    </script>";
                            } catch (Exception $e) {
                                echo "<script>
                                        Swal.fire({
                                            icon: 'error',
                                            text: 'Error al añadir la relación: " . $e->getMessage() . "',
                                            confirmButtonText: 'OK'
                                        });
                                    </script>";
                            }
                        }
                    }

                    try {
                        $sqlMostrar5 = "SELECT director_pelicula.id_director_pelicula AS id_director_pelicula, 
                                        directores.nombre_director AS Director, 
                                        peliculas.nombre AS Pelicula 
                                        FROM director_pelicula 
                                        LEFT JOIN directores ON directores.id_director = director_pelicula.id_director 
                                        LEFT JOIN peliculas ON peliculas.id_pelicula = director_pelicula.id_pelicula";
                        $stmtMostrar5 = $conn->prepare($sqlMostrar5);
                        $stmtMostrar5->execute();
                        $resultado5 = $stmtMostrar5->fetchAll(PDO::FETCH_ASSOC);

                        if ($resultado5) {
                            echo "<table class='table mt-3 flex'>
                                    <tr>
                                        <th class='estilosTh'>ID</th>
                                        <th class='estilosTh'>Director</th>
                                        <th class='estilosTh'>Pelicula</th>
                                        <th class='estilosTh'></th>
                                        <th class='estilosTh'></th>
                                    </tr>";

                            foreach ($resultado5 as $fila5) {
                                echo "<tr>
                                        <td class='estilosTd'>".$fila5['id_director_pelicula']."</td>
                                        <td class='estilosTd'>".$fila5['Director']."</td>
                                        <td class='estilosTd'>".$fila5['Pelicula']."</td>
                                        <td class='estilosTd'><a href='./proc/editarDirectorPelicula.php?id_director_pelicula=" . $fila5['id_director_pelicula'] . "'><button id='editar'>Editar</button></a></td>
                                        <td class='estilosTd'>
                                            <button id='eliminar' class='btnEliminarDirectorPelicula' data-director-pelicula-id='".$fila5['id_director_pelicula']."'>Eliminar</button>
                                        </td>
                                    </tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                        }
                        $stmtMostrar5->closeCursor();
                    } catch(Exception $e) {
                        echo "Error: ". $e->getMessage();
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
                        <label for="genero" class="textos">Nombre:</label>
                        <input type="text" name="genero" id="administraciones" value="<?php if(isset($_POST['genero'])) {echo $_POST['genero'];} ?>">
                        <br><br>
                        <div class="flex">
                            <button type='submit' name='añadir7' value='añadir7' id="administrar" class="btn btn-1">Añadir</button>
                        </div>
                    </form>
                </header>

                <?php
                // Procesar el formulario de añadir género
                if (isset($_POST['añadir7'])) {
                    // Validación del campo
                    if (empty($_POST['genero'])) {
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Por favor, ingrese un nombre para el género.'
                                });
                            </script>";
                    } else {
                        try {
                            $genero = $_POST['genero'];

                            // Insertar el género en la base de datos
                            $sqlInsertar7 = "INSERT INTO genero (nombre) VALUES (:genero)";
                            $stmtInsertar7 = $conn->prepare($sqlInsertar7);
                            $stmtInsertar7->bindParam(':genero', $genero);
                            $stmtInsertar7->execute();

                            // Alerta de éxito
                            echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Género Añadido',
                                        text: 'El género ha sido añadido exitosamente.'
                                    });
                                </script>";
                        } catch (Exception $e) {
                            // En caso de error en la inserción
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Ocurrió un error al añadir el género: " . $e->getMessage() . "'
                                    });
                                </script>";
                        }
                    }
                }

                // Mostrar los géneros existentes
                try {
                    $sqlMostrar7 = "SELECT id_genero AS id_genero, nombre AS Genero FROM genero";
                    $stmtMostrar7 = $conn->prepare($sqlMostrar7);
                    $stmtMostrar7->execute();
                    $resultado7 = $stmtMostrar7->fetchAll(PDO::FETCH_ASSOC);

                    if ($resultado7) {
                        echo "<table class='table mt-3 flex'>
                                <tr>
                                    <th class='estilosTh'>ID</th>
                                    <th class='estilosTh'>Genero</th>
                                    <th class='estilosTh'></th>
                                    <th class='estilosTh'></th>
                                </tr>";

                        foreach ($resultado7 as $fila7) {
                            echo "<tr>
                                    <td class='estilosTd'>".$fila7['id_genero']."</td>
                                    <td class='estilosTd'>".$fila7['Genero']."</td>
                                    <td class='estilosTd2'><a href='./proc/editarGeneros.php?id_genero=" . $fila7['id_genero'] . "'><button id='editar'>Editar</button></a></td>
                                    <td class='estilosTd3'>
                                        <button id='eliminar' class='btnEliminarGenero' data-genero-id='". $fila7['id_genero']."'>Eliminar</button>
                                    </td>
                                </tr>";
                        } 
                        echo "</table>";
                    } else {
                        echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                    }
                    $stmtMostrar7->closeCursor();
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
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
                        <input type="text" name="rol" id="administraciones" value="<?php if(isset($_POST['rol'])) {echo $_POST['rol'];} ?>">
                        <br><br>
                        <div class="flex">
                            <button type='submit' name='añadir8' value='añadir8' id="administrar" class="btn btn-1">Añadir</button>
                        </div>
                    </form>
                </header>

                <?php
                // Procesar el formulario de añadir rol
                if (isset($_POST['añadir8'])) {
                    // Validación del campo
                    if (empty($_POST['rol'])) {
                        echo "<script>
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Por favor, ingrese un nombre para el rol.'
                                });
                            </script>";
                    } else {
                        try {
                            $rol = $_POST['rol'];

                            // Insertar el rol en la base de datos
                            $sqlInsertar8 = "INSERT INTO roles (rol) VALUES (:rol)";
                            $stmtInsertar8 = $conn->prepare($sqlInsertar8);
                            $stmtInsertar8->bindParam(':rol', $rol);
                            $stmtInsertar8->execute();

                            // Alerta de éxito
                            echo "<script>
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Rol Añadido',
                                        text: 'El rol ha sido añadido exitosamente.'
                                    });
                                </script>";
                        } catch (Exception $e) {
                            // En caso de error en la inserción
                            echo "<script>
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: 'Ocurrió un error al añadir el rol: " . $e->getMessage() . "'
                                    });
                                </script>";
                        }
                    }
                }

                // Mostrar los roles existentes
                try {
                    $sqlMostrar8 = "SELECT id_rol AS id_rol, rol AS Rol FROM roles";
                    $stmtMostrar8 = $conn->prepare($sqlMostrar8);
                    $stmtMostrar8->execute();
                    $resultado8 = $stmtMostrar8->fetchAll(PDO::FETCH_ASSOC);

                    if ($resultado8) {
                        echo "<table class='table mt-3 flex'>
                                <tr>
                                    <th class='estilosTh'>ID</th>
                                    <th class='estilosTh'>Rol</th>
                                    <th class='estilosTh'></th>
                                    <th class='estilosTh'></th>
                                </tr>";

                        foreach ($resultado8 as $fila8) {
                            echo "<tr>
                                    <td class='estilosTd'>".$fila8['id_rol']."</td>
                                    <td class='estilosTd'>".$fila8['Rol']."</td>
                                    <td class='estilosTd2'><a href='./proc/editarRoles.php?id_rol=" . $fila8['id_rol'] . "'><button id='editar'>Editar</button></a></td>
                                    <td class='estilosTd3'>
                                        <button id='eliminar' class='btnEliminarRol' data-rol-id='".$fila8['id_rol']."'>Eliminar</button>
                                    </td>
                                </tr>";
                        } 
                        echo "</table>";
                    } else {
                        echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                    }
                    $stmtMostrar8->closeCursor();
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
        <div id="tab7" class="tab-content ActivarUsuarios">
            <h1 id="titulo">Activar Usuarios</h1>
            <div class="tablas">

                <?php
                // Mostrar los roles existentes
                try {
                    $sqlMostrar8 = "SELECT id_usuarios, nombre AS Nombre, email AS Correo, estado AS Estado FROM usuarios";
                    $stmtMostrar8 = $conn->prepare($sqlMostrar8);
                    $stmtMostrar8->execute();
                    $resultado8 = $stmtMostrar8->fetchAll(PDO::FETCH_ASSOC);

                    if ($resultado8) {
                        echo "<table class='table mt-3 flex'>
                                <tr>
                                    <th class='estilosTh'>Nombre</th>
                                    <th class='estilosTh'>Correo</th>
                                    <th class='estilosTh'>Estado</th>
                                    <th class='estilosTh'></th>
                                </tr>";

                        foreach ($resultado8 as $fila8) {

                            echo "<tr>
                                    <td class='estilosTd'>".$fila8['Nombre']."</td>
                                    <td class='estilosTd'>".$fila8['Correo']."</td>
                                    <td class='estilosTd'>".$fila8['Estado']."</td>
                                    <td class='estilosTd2'><button id='activar' class='cambiarEstadoUsuario' data-usuario-id=".$fila8['id_usuarios'].">Cargando...</button></td>
                                </tr>";
                        } 
                        echo "</table>";
                    } else {
                        echo "<p class='texto3'>NO SE ENCONTRARON REGISTROS</p>";
                    }
                    $stmtMostrar8->closeCursor();
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
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

        
        var cambiarEstadoUsuario = document.querySelectorAll(".cambiarEstadoUsuario");
        
        cambiarEstadoUsuario.forEach(enlace => {
            
            var IdUsuario = enlace.getAttribute("data-usuario-id");
            
            fetch("./proc/comprobarEstadoUsuario.php", {      
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ usuarioId: IdUsuario })              
            })
            .then(res => res.json())
            .then(datos => {
                
                if (datos.estado === "desactivado" || datos.estado === "registrado") {
                    
                    enlace.textContent = "Activar";
                    enlace.style.width = "70px";
                    
                } else {
                    
                    enlace.textContent = "Desactivar";
                    enlace.style.width = "90px";
                    
                }
                
            })
            .catch(error => console.error("Error al comprobar estado:", error));
            
            enlace.onclick = () => {
                
                fetch("./proc/activarDesactivarUsuario.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({ usuarioId: IdUsuario })
                })
                .then(res => res.json())
                .then(datos => {
                    
                    if (datos.nuevoEstado === "desactivado" || datos.estado === "registrado") {

                        enlace.textContent = "Activar";
                        enlace.style.width = "70px";

                    } else {

                        enlace.textContent = "Desactivar";
                        enlace.style.width = "90px";

                    }
                    
                })
                .catch(error => console.error("Error al cambiar estado:", error));
                
            }
        });

        var eliminarUsuarios = document.querySelectorAll(".btnEliminarUsuarios");

        eliminarUsuarios.forEach(boton => {

            boton.onclick = () => {
                var id_usuario = boton.getAttribute("data-usuario-id");
                eliminarUsuario(id_usuario);
            };

        });

        function eliminarUsuario(id_usuario) {

            Swal.fire({

                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"

            }).then((resultado) => {
                if (resultado.isConfirmed) {
                    fetch('./proc/eliminarUsuarios.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_usuarios: id_usuario })
                    })
                    .then(response => response.json())
                    .then(datos => {
                        if (datos.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Usuario Eliminado",
                                text: "El usuario ha sido eliminado exitosamente.",
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: datos.error || "No se pudo eliminar el usuario.",
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Hubo un problema al conectar con el servidor.",
                        });
                    });
                }
            });

        }
        
        var eliminarPeliculas = document.querySelectorAll(".btnEliminarPelicula");

        eliminarPeliculas.forEach(boton => {

            boton.onclick = () => {
                var id_pelicula = boton.getAttribute("data-pelicula-id");
                eliminarPelicula(id_pelicula);
            };

        });

        function eliminarPelicula(id_pelicula) {

            Swal.fire({

                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"

            }).then((resultado) => {

                if (resultado.isConfirmed) {
                    fetch('./proc/eliminarPeliculas.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_pelicula: id_pelicula })
                    })
                    .then(response => response.json())
                    .then(datos => {
                        if (datos.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Película Eliminada",
                                text: "La película ha sido eliminada exitosamente."
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: datos.error || "No se pudo eliminar la película."
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Hubo un problema al conectar con el servidor."
                        });
                    });
                }

            });

        }

        var eliminarActores = document.querySelectorAll(".btnEliminarActor");

        eliminarActores.forEach(boton => {

            boton.onclick = () => {
                var id_actor = boton.getAttribute("data-actor-id");
                eliminarActor(id_actor);
            };

        });

        function eliminarActor(id_actor) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./proc/eliminarActor.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_actor: id_actor })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Actor Eliminado",
                                text: "El actor ha sido eliminado exitosamente."
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.error || "No se pudo eliminar el actor."
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Hubo un problema al conectar con el servidor."
                        });
                    });
                }
            });
        }

        var eliminarActoresPeliculas = document.querySelectorAll(".btnEliminarActorPelicula");

        eliminarActoresPeliculas.forEach(boton => {

            boton.onclick = () => {
                var id_actor_pelicula = boton.getAttribute("data-actor-pelicula-id");
                eliminarActorPelicula(id_actor_pelicula);
            };

        });

        function eliminarActorPelicula(id_actor_pelicula) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./proc/eliminarActorPelicula.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_actor_pelicula: id_actor_pelicula })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Relación Eliminada",
                                text: "La relación entre el actor y la película ha sido eliminada exitosamente."
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.error || "No se pudo eliminar la relación."
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Hubo un problema al conectar con el servidor."
                        });
                    });
                }
            });
        }

        var eliminarDirectores = document.querySelectorAll(".btnEliminarDirector");

        eliminarDirectores.forEach(boton => {

            boton.onclick = () => {
                var id_director = boton.getAttribute("data-director-id");
                eliminarDirector(id_director);
            };

        });

        function eliminarDirector(id_director) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./proc/eliminarDirector.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_director: id_director })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Director Eliminado",
                                text: "El director ha sido eliminadao exitosamente."
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.error || "No se pudo eliminar el director."
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Hubo un problema al conectar con el servidor."
                        });
                    });
                }
            });
        }

        var eliminarDirectoresPeliculas = document.querySelectorAll(".btnEliminarDirectorPelicula");

        eliminarDirectoresPeliculas.forEach(boton => {

            boton.onclick = () => {
                var id_director_pelicula = boton.getAttribute("data-director-pelicula-id");
                eliminarDirectorPelicula(id_director_pelicula);
            };

        });

        function eliminarDirectorPelicula(id_director_pelicula) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./proc/eliminarDirectorPelicula.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_director_pelicula: id_director_pelicula })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Relación Eliminada",
                                text: "La relación entre el director y la película ha sido eliminada exitosamente."
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.error || "No se pudo eliminar la relación."
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Hubo un problema al conectar con el servidor."
                        });
                    });
                }
            });
        }

        var eliminarGeneros = document.querySelectorAll(".btnEliminarGenero");

        eliminarGeneros.forEach(boton => {
            boton.onclick = () => {
                var id_genero = boton.getAttribute("data-genero-id");
                eliminarGenero(id_genero);
            };
        });

        function eliminarGenero(id_genero) {

            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./proc/eliminarGeneros.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_genero: id_genero })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Género Eliminado",
                                text: "El género ha sido eliminado exitosamente."
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.error || "No se pudo eliminar el género."
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Hubo un problema al conectar con el servidor."
                        });
                    });
                }
            });

        }

        var eliminarRoles = document.querySelectorAll(".btnEliminarRol");

        eliminarRoles.forEach(boton => {
            boton.onclick = () => {
                var id_rol = boton.getAttribute("data-rol-id");
                eliminarRol(id_rol);
            };
        });

        function eliminarRol(id_rol) {
            Swal.fire({
                title: "¿Estás seguro?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Sí, eliminar",
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch('./proc/eliminarRoles.php', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id_rol: id_rol })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Rol Eliminado",
                                text: "El rol ha sido eliminado exitosamente."
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: data.error || "No se pudo eliminar el rol."
                            });
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: "Hubo un problema al conectar con el servidor."
                        });
                    });
                }
            });
        }
        
    </script>
</body>
</html>
<?php
    }else {
        header("Location: ../login/login.php");
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>