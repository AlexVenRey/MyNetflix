<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/OIG.png" type="image/x-icon">
    <link rel="stylesheet" href="./editar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
</head>
<body class="banner">
    <h3 id="titulo">Editar Usuarios</h3>
    <div class="page-border">
        <?php
        include_once("../../conexion/conexion.php");

        if (isset($_GET['id_usuarios'])) {
            $sqlUsuarios = "SELECT id_usuarios, nombre, apellidos, email, contrasena, roles.rol FROM usuarios LEFT JOIN roles ON usuarios.rol = roles.id_rol WHERE id_usuarios = :id_usuarios";
            $stmtUsuarios = $conn->prepare($sqlUsuarios);
            $stmtUsuarios->bindParam(':id_usuarios', $_GET['id_usuarios']);
            $stmtUsuarios->execute();
            $resultado = $stmtUsuarios->fetch(PDO::FETCH_ASSOC);
        ?>
            <form id="editarUsuarioForm" method="POST" style="text-align: center;">
                <input type="hidden" name="id_usuarios" id="administraciones" value="<?php echo $resultado['id_usuarios']; ?>">
                <div class="inputs">
                    <label for="nombre" class="textos5" >Nombre</label><br>
                    <input type="text" name="nombre" id="administraciones" value="<?php echo $resultado['nombre']; ?>" required>
                </div>
                <div class="inputs">
                    <label for="apellidos" class="textos5" >Apellidos</label><br>
                    <input type="text" name="apellidos" id="administraciones" value="<?php echo $resultado['apellidos']; ?>" required>
                </div>
                <div class="inputs">
                    <label for="email" class="textos5" >Correo</label><br>
                    <input type="email" name="email" id="administraciones" value="<?php echo $resultado['email']; ?>" required>
                </div>
                <div class="inputs">
                    <label for="contrasena" class="textos5" >Contraseña</label><br>
                    <?php
                    $contrasena = ($resultado['contrasena'] != null && $resultado['contrasena'] != '') ? "······" : "No hay contraseña";
                    ?>
                    <input type="password" name="contrasena" id="administraciones" value="<?php echo $contrasena; ?>" required>
                    <input type="hidden" name="contrasena_existente" value="<?php echo $resultado['contrasena']; ?>">
                </div>
                <div class="inputs">
                    <label for="rol" class="textos5" >Rol</label><br>
                    <select name="rol" id="administraciones">
                        <?php
                        $sqlRoles = "SELECT id_rol, rol FROM roles";
                        $stmtRoles = $conn->prepare($sqlRoles);
                        $stmtRoles->execute();
                        $roles = $stmtRoles->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($roles as $rolOption) {
                            ?>
                            <option value="<?php echo $rolOption['id_rol']; ?>" <?php if ($rolOption['rol'] == $resultado['rol']) { echo 'selected'; } ?>><?php echo $rolOption['rol']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-1" id="editarAdmin">Actualizar</button>
            </form>
        <?php } ?>

    </div>

    <script>
        document.getElementById('editarUsuarioForm').onsubmit = actualizarUsuario;

        function actualizarUsuario(event) {
            event.preventDefault();

            var form = event.target;
            var formData = new FormData(form);

            fetch('procesoEditarUsuario.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "../administrar.php"
                } else {
                    alert('Error al actualizar el usuario');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Hubo un error al actualizar el usuario.');
            });
        }
    </script>

</body>
</html>
