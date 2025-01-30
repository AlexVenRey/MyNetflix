<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Whatsapp2 - Register</title>
    <link rel="shortcut icon" href="../src/LOGO/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="./register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300;400;500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="flex" id="oscuro">
        <div class="container">
            <h2 class="flex" id="titulo">REGISTRO</h2>
            <br>
            <form action="./procesos/validate.proc.php" method="POST">
                <div class="inputs">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?php if(isset($_GET['username'])) {echo $_GET['username'];} ?>">
                    <?php if (isset($_GET['usernameVacio'])) {echo "<br><br><p class='editaNombre'>Falta tu nombre</p>"; } ?>
                    <?php if (isset($_GET['usernameMal'])) {echo "<br><br><p class='editaNombre'>Tu nombre solo puede contener letras y números</p>"; } ?>
                </div>
                <div class="inputs">
                    <label for="apellido">Apellido:</label>
                    <input type="text" class="form-control" name="surname" id="surname" value="<?php if(isset($_GET['surname'])) {echo $_GET['surname'];} ?>">
                    <?php if (isset($_GET['apellidoVacio'])) {echo "<br><br><p class='editaApellido'>Falta tu apellido</p>"; } ?>
                    <?php if (isset($_GET['apellidoMal'])) {echo "<br><br><p class='editaApellido'>Tu apellido solo puede contener letras y números</p>"; } ?>
                </div>
                <div class="inputs">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($_GET['email'])) {echo $_GET['email'];} ?>">
                    <?php if (isset($_GET['emailVacio'])) {echo "<br><br><p class='editaCorreo'>Falta tu correo</p>"; } ?>
                    <?php if (isset($_GET['emailMal'])) {echo "<br><br><p class='editaCorreo'>Tu correo debe contener un @</p>"; } ?>
                </div>
                <div class="inputs">
                    <label for="password">Contraseña:</label>
                    <input type="password" class="form-control" name="password" id="password">
                    <?php if (isset($_GET['contrasenaVacio'])) {echo "<br><br><p class='editaContraseña'>Escribe tu contraseña</p>"; } ?>
                    <?php if (isset($_GET['contrasenaMal'])) {echo "<br><br><p class='editaContraseña'>No puede contener símbolos (#$%&@)</p>"; } ?>
                </div>
                <div class="inputs">
                    <label for="confirm-password">Confirmar Contraseña:</label>
                    <input type="password" class="form-control" name="conf_password" id="confirm_password">
                    <?php if (isset($_GET['contrasena2Vacio'])) {echo "<br><br><p class='editaConfirmarContraseña'>Vuelve a escribir tu contraseña</p>"; } ?>
                    <?php if (isset($_GET['contrasena2Mal'])) {echo "<br><br><p class='editaConfirmarContraseña'>Tu apellido solo puede contener letras y números</p>"; } ?>
                    <?php if (isset($_GET['contrasena2Repetir'])) {echo "<br><br><p class='editaConfirmarContraseña'>Tienes que escribir la misma contraseña</p>"; } ?>
                </div>
                <br>
                <button type="submit" name="register" value="register" class="boton">Registrarse</button>
                <br>
                <p id="registrarse">Ya tienes cuenta?
                    <a href="../login/login.php" id="registrarse">Inicia Sesión</p></a>
            </form>
</body>

</html>