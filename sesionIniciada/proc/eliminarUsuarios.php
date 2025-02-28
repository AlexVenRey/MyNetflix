<?php
    include_once('../../conexion/conexion.php');
    $id_usuarios = $_GET['id_usuarios'];
    $eliminarUsuario = $conn->prepare("DELETE FROM usuarios WHERE id_usuarios = :id_usuarios");
    $eliminarUsuario->bindParam(':id_usuarios', $id_usuarios);
    $eliminarUsuario->execute();

    echo "<script>
    Swal.fire({
        icon: 'success',
        title: 'Usuario Eliminado',
        text: 'El usuario ha sido eliminado.'
    }).then(() => {
        window.location.href = '../administrar.php';
    });
    </script>";

?>