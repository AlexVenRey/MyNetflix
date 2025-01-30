<?php
$error="";
function validaCampoVacio($campo) {
    if(empty($campo)){
        $error= true; //Hay un error
    }else{
        $error= false; //No hay un error
    }
    return $error;
}

$errores="";

$username = $_POST['username'];
$contrasena = $_POST['password'];

include("../../conexion/conexion.php");

if (validaCampoVacio($username)){
    if (!$errores){
        $errores .="?usernameVacio=true";
    } else {
        $errores .="&usernameVacio=true";        
    }
}

if (validaCampoVacio($contrasena)){
    if (!$errores){
        $errores .="?contrasenaVacio=true";
     } else {
        $errores .="&contrasenaVacio=true";        
     }
}

/* La variable 'sql' hace una consulta donde: selecciona todo de la tabla 'tbl_users' donde el usuario es igual a la variable '$user' y la contrasena igual a la variable '$contrasena' */ 
// $sql=$mysqli->query("SELECT * FROM tbl_users WHERE username='$username'");
$sql = "SELECT * FROM usuarios WHERE nombre=:username";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$consulta = $stmt->fetch(PDO::FETCH_ASSOC);

if ($consulta) {
    /*Creamos un hash que recojerá la contrasaena de la base de datos*/
    $id_usuarios=$consulta['id_usuarios'];
    $hashContrasena=$consulta['contrasena'];
    
    /*Comprobamos que la contrasena puesta sea igual a la de la base de datos (el hash)*/
    if (password_verify($contrasena, $hashContrasena)) {
        /* Creamos la sesión */
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['id_usuarios'] = $id_usuarios;
        header("location: ../../index.php");
    } else {
        if ($contrasena != "") {
            if (!$errores){
                $errores .="?contrasenaMal=true";
            } else {
                $errores .="&contrasenaMal=true";        
            }
        }
            
    }    
}

else {
    if ($username != "") {
            if (!$errores){
                $errores .="?usernameMal=true";
            } else {
                $errores .="&usernameMal=true";        
            }
    }
        
}

if ($errores!=""){

    $datosRecibidos = array(
        'username' => $username,
        'password' => $contrasena,
    );

    $datosDevueltos=http_build_query($datosRecibidos);
    header("Location: ../login.php". $errores. "&". $datosDevueltos);
    exit();
}else{
    echo"<form id='EnvioCheck' action='../../index.php' method='POST'>";
    echo"<input type='hidden' id='username' name='username' value='".$username."'>";
    echo"<input type='hidden' id='password' name='password' value='".$contrasena."'>";
    echo"</form>";
    echo "<script>document.getElementById('EnvioCheck').submit();</script>";
}