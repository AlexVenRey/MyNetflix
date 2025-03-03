<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Rol</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../img/OIG.png" type="image/x-icon">
    <link rel="stylesheet" href="./editar.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400&display=swap" rel="stylesheet">
</head>
<body class="banner">
    <h3 id="titulo">Editar Rol</h3>
    <div class="page-border">
    <?php
        include_once("../../conexion/conexion.php");
        if (isset($_GET['id_rol'])) {
            $sqlRol = "SELECT id_rol, rol FROM roles WHERE id_rol = :id_rol";
            $stmtRol = $conn->prepare($sqlRol);
            $stmtRol->bindParam(':id_rol', $_GET['id_rol']);
            $stmtRol->execute();
            $rol = $stmtRol->fetch(PDO::FETCH_ASSOC);
    ?>
    <form id="editarRolForm" method="POST" style="text-align: center;">
        <input type="hidden" name="id_rol" value="<?php echo $rol['id_rol']; ?>">
        <div class="inputs">
        <label for="rol" class="textos5">Nombre del Rol</label><br>
        <input type="text" name="rol" id="administraciones" value="<?php echo $rol['rol']; ?>" required>
        </div>
        <br>
        <button type="submit" class="btn btn-1" id="editarAdmin">Actualizar</button>
    </form>
    <?php } ?>
    </div>

    <script>
        document.getElementById('editarRolForm').onsubmit = actualizarRol;

        function actualizarRol(event) {
            event.preventDefault();
            var form = event.target;
            var formData = new FormData(form);

            fetch('procesoEditarRoles.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
            if (data.success) {

                window.location.href = "../administrar.php";

            } else {

                alert('Error al actualizar el rol');

            }
            })
            .catch(error => {
            console.error('Error:', error);
            alert('Hubo un error al actualizar el rol.');
            });
        }
    </script>
</body>
</html>