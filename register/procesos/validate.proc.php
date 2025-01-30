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
?>

<?php
if (!filter_has_var(INPUT_POST, 'register')) {
    header('Location: '.'./register.proc.php');
    exit();
} else {

$errores="";

$username = $_POST['username'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$contrasena = $_POST['password'];
$confirmar_contrasena = $_POST['conf_password'];


if (validaCampoVacio($username)){
    if (!$errores){
        $errores .="?usernameVacio=true";
     } else {
        $errores .="&usernameVacio=true";        
     }
  } else {
    if(!preg_match("/^[a-zA-Z0-9]*$/",$username)){
        if (!$errores){
            $errores .="?usernameMal=true";
         } else {
            $errores .="&usernameMal=true";        
         }
    }
}

if (validaCampoVacio($surname)){
    if (!$errores){
        $errores .="?apellidoVacio=true";
     } else {
        $errores .="&apellidoVacio=true";        
     }
  } else {
    if(!preg_match("/^[a-zA-Z0-9]*$/",$surname)){
        if (!$errores){
            $errores .="?apellidoMal=true";
         } else {
            $errores .="&apellidoMal=true";        
         }
    }
}

if (validaCampoVacio($email)){
    if (!$errores){
        $errores .="?emailVacio=true";
     } else {
        $errores .="&emailVacio=true";        
     }
  } else {
    if(!filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)){
        if (!$errores){
            $errores .="?emailMal=true";
         } else {
            $errores .="&emailMal=true";        
         }
    }
}

if (validaCampoVacio($contrasena)){
    if (!$errores){
        $errores .="?contrasenaVacio=true";
     } else {
        $errores .="&contrasenaVacio=true";        
     }
  } else {
    if(!preg_match("/^[a-zA-Z0-9]*$/",$contrasena)){
        if (!$errores){
            $errores .="?contrasenaMal=true";
         } else {
            $errores .="&contrasenaMal=true";        
         }
    }
}

if (validaCampoVacio($confirmar_contrasena)){
    if ($contrasena != "") {
        if (!$errores){
            $errores .="?contrasena2Vacio=true";
        } else {
            $errores .="&contrasena2Vacio=true";        
        }
    }
    
    } else {
    if(!preg_match("/^[a-zA-Z0-9]*$/",$confirmar_contrasena)){
        if (!$errores){
            $errores .="?contrasena2Mal=true";
        } else {
            $errores .="&contrasena2Mal=true";        
        }
    }
    else if ($contrasena != $confirmar_contrasena) {
        if (!$errores){
            $errores .="?contrasena2Repetir=true";
        } else {
            $errores .="&contrasena2Repetir=true";        
        }
    }
    
}

if ($errores!=""){

    $datosRecibidos = array(
        'username' => $username,
        'surname'=> $surname,
        'email' => $email,
        'password' => $contrasena,
        'conf_password' => $confirmar_contrasena 
    );
    
    $datosDevueltos=http_build_query($datosRecibidos);
    header("Location: ../register.php". $errores. "&". $datosDevueltos);
    exit();
}else{
    echo"<form id='EnvioCheck' action='register.proc.php' method='POST'>";
    echo"<input type='hidden' id='username' name='username' value='".$username."'>";
    echo"<input type='hidden' id='surname' name='surname' value='".$surname."'>";
    echo"<input type='hidden' id='email' name='email' value='".$email."'>";
    echo"<input type='hidden' id='password' name='password' value='".$contrasena."'>";
    echo"<input type='hidden' id='confirm_password' name='conf_password' value='".$confirmar_contrasena."'>";
    echo"</form>";
    echo "<script>document.getElementById('EnvioCheck').submit();</script>";
 }
}

