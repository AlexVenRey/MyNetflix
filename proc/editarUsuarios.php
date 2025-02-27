
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar Usuarios</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="shortcut icon" href="../img/OIG.png" type="image/x-icon">
        <link rel="stylesheet" href="../editar.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
    </head>
    <body class="banner">
    <br><br><br><br><br>
    <h3 id="titulo">Editar Usuarios</h3>
    <div class="page-border">
        <?php
        include_once("../conexion/conexion.php");//incluimos archivo de conexion
            try{
                if (isset($_GET['id_usuarios'])) {
                    $sqlUsuarios = "SELECT id_usuarios AS id_usuarios, nombre AS Nombre, apellidos AS Apellidos, email AS Correo, contrasena AS Contraseña,
                    roles.rol AS Rol, suscripciones.suscripcion AS Suscripcion FROM usuarios LEFT JOIN roles ON usuarios.rol = roles.id_rol
                    LEFT JOIN suscripciones ON suscripciones.id_suscripcion = usuarios.suscripcion WHERE id_usuarios = :id_usuarios ORDER BY id_usuarios ASC";
                    $stmtUsuarios = $conn->prepare($sqlUsuarios);
                    $stmtUsuarios->bindParam(':id_usuarios',$_GET['id_usuarios']);
                    $stmtUsuarios->execute();
                    $resultado = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($resultado as $row) {
                ?>      
                    <form action="" method="POST" style="text-align: center;">
                        <input type="hidden" name="id_usuarios" value="<?php echo $row['id_usuarios']; ?>">
                        <div class="inputs">
                            <label for="nombre" class="textos5">Nombre</label>
                            <br>
                            <input type="text" name="nombre" id="administraciones" value="<?php echo $row['Nombre']; ?>" required>
                        </div>
                        <div class="inputs">
                            <label for="apellidos" class="textos5">Apellidos</label>
                            <br>
                            <input type="text" name="apellidos" id="administraciones" value="<?php echo $row['Apellidos']; ?>" required>
                        </div>
                        <div class="inputs">
                            <label for="correo" class="textos5">Correo</label>
                            <br>
                            <input type="email" name="email" id="administraciones" value="<?php echo $row['Correo']; ?>" style="width: 16%;" required>
                        </div>
                        <div class="inputs">
                            <label for="contrasena" class="textos5">Contraseña</label>
                            <br>
                            <input type="text" name="contrasena" id="administraciones" value="<?php echo $row['Contraseña']; ?>" style="width: 44%;" required>
                        </div>
                        <div class="inputs">
                            <label for="rol" class="textos5">Rol</label>
                            <br>
                            <select name='rol' id="administraciones">
                                <?php
                                $sqlRoles = "SELECT id_rol, rol FROM roles";
                                // Preparación y ejecución de la consulta para obtener mesas
                                $stmtRoles = $conn->prepare($sqlRoles);
                                $stmtRoles->execute();
                                $roles = $stmtRoles->fetchAll(PDO::FETCH_ASSOC);
                                //mostramos las roles de la bd que tenemos guardadas en el array
                                foreach ($roles as $rolOption) {
                                    ?>
                                    <option value="<?php echo $rolOption['id_rol']; ?>" <?php if ($rolOption['rol'] == $row['Rol']) { echo 'selected'; }?>><?php echo $rolOption['rol']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="inputs">
                            <label for="suscripcion" class="textos5">Suscripción</label>
                            <br>
                            <select name='suscripcion' id="administraciones">
                                 <?php
                                    $sqlSuscripciones = "SELECT id_suscripcion, suscripcion FROM suscripciones";
                                    // Preparación y ejecución de la consulta para obtener suscripciones
                                    $stmtSuscripciones = $conn->prepare($sqlSuscripciones);
                                    $stmtSuscripciones->execute();
                                    $suscripciones = $stmtSuscripciones->fetchAll(PDO::FETCH_ASSOC);
                                    //mostramos los suscripciones de la bd que tenemos guardados en el array
                                    foreach ($suscripciones as $suscripcionOption) {
                                    ?>
                                    <option value="<?php echo $suscripcionOption['id_suscripcion']; ?>" <?php if ($suscripcionOption['suscripcion'] == $row['Suscripcion']) { echo 'selected'; } else { } ?>><?php echo $suscripcionOption['suscripcion']; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-1" id="editarAdmin" name='actualizar' value='actualizar'>Actualizar</button>
                    </form>
                <?php
                ?>
                <?php
                    }
                    if (isset($_POST['actualizar'])) {
                        $id_usuarios = $_POST['id_usuarios'];
                        $nombre = $_POST['nombre'];
                        $apellidos = $_POST['apellidos'];
                        $email = $_POST['email'];
                        if ($_POST['contrasena'] === $row['Contraseña']) {
                            $contrasena = $_POST['contrasena'];
                        } else {
                            $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
                        }
                        $rol = $_POST['rol'];
                        $suscripcion = $_POST['suscripcion'];
                        // Preparar la consulta SQL
                        $sqlInsertar = $conn->prepare('UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, email = :email, contrasena = :contrasena, rol = :rol, suscripcion = :suscripcion WHERE id_usuarios = :id_usuarios');
                        $sqlInsertar->bindParam(':id_usuarios', $id_usuarios);
                        $sqlInsertar->bindParam(':nombre',$nombre);
                        $sqlInsertar->bindParam(':apellidos',$apellidos);
                        $sqlInsertar->bindParam(':email',$email);
                        $sqlInsertar->bindParam(':contrasena',$contrasena);
                        $sqlInsertar->bindParam(':rol',$rol);
                        $sqlInsertar->bindParam(':suscripcion',$suscripcion);
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