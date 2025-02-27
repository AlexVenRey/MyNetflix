<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$dbserver= "localhost";
$dbusername="root";
$dbpassword="";
$dbbasedatos="db_bluevideo";

try{
    // $conn = @mysqli_connect($dbserver, $dbusername, $dbpassword, $dbbasedatos);
$conn = new PDO("mysql:host=$dbserver;dbname=$dbbasedatos",$dbusername,$dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

} catch (Exception $e){
    echo "Error en la conexión con la base de datos: " . $e->getMessage();
    die();
}
?>