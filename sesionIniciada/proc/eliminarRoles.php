<?php
include_once('../../conexion/conexion.php');
$id_rol = $_GET['id_rol'];

try {
    // Iniciar una transacción
    $conn->beginTransaction();

    $eliminarUsuario = $conn->prepare("DELETE FROM usuarios WHERE rol_id = :id_rol");
    $eliminarUsuario->bindParam(':id_rol', $id_rol);
    $eliminarUsuario->execute();

    $eliminarRol = $conn->prepare("DELETE FROM roles WHERE id_rol = :id_rol");
    $eliminarRol->bindParam(':id_rol', $id_rol);
    $eliminarRol->execute();

    // Confirmar la transacción
    $conn->commit();

    // Alerta de éxito
    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Rol eliminado',
        text: 'El rol y todos los usuarios asociados han sido eliminados.'
    }).then(() => {
        window.location.href = '../administrar.php';
    });
    </script>";

} catch (Exception $e) {

    $conn->rollBack();
    echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Ocurrió un error al eliminar el rol o los usuarios: " . $e->getMessage() . "'
            }).then(() => {
                window.location.href = '../administrar.php';
            });
          </script>";
}
?>
