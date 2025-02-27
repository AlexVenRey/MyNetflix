<?php
include_once('../../conexion/conexion.php');
$id_rol = $_GET['id_rol'];

// Obtener el rol actual
$query = $conn->prepare("SELECT rol FROM roles WHERE id_rol = :id_rol");
$query->bindParam(':id_rol', $id_rol);
$query->execute();
$rolData = $query->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nuevoRol = $_POST['rol'];

    // Validación
    if (empty($nuevoRol)) {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor, ingrese un nombre para el rol.'
                });
              </script>";
    } else {
        try {
            // Actualizar el nombre del rol
            $updateQuery = $conn->prepare("UPDATE roles SET rol = :rol WHERE id_rol = :id_rol");
            $updateQuery->bindParam(':rol', $nuevoRol);
            $updateQuery->bindParam(':id_rol', $id_rol);
            $updateQuery->execute();

            // Alerta de éxito
            echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Rol Actualizado',
                        text: 'El rol ha sido actualizado exitosamente.'
                    }).then(() => {
                        window.location.href = '../administrar.php';
                    });
                  </script>";
        } catch (Exception $e) {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Ocurrió un error al actualizar el rol: " . $e->getMessage() . "'
                    });
                  </script>";
        }
    }
}
?>

<form action="" method="post">
    <label for="rol">Nuevo Nombre del Rol:</label>
    <input type="text" name="rol" value="<?php echo htmlspecialchars($rolData['rol']); ?>" id="administraciones">
    <br><br>
    <button type="submit" id="administrar" class="btn btn-1">Actualizar Rol</button>
</form>
