<?php
require ('../DAL/conexion.php');
    $con =new Conexion();
    $bd = $con->conectar();
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];

try {
    // $SQLQuery = "SELECT * FROM usuarios WHERE nombre = '$user' AND contrasena = '$pass' ";
    $SQLQuery = "CALL SP_valida_usuario('$user','$pass') ";
    $result = $bd->query($SQLQuery);
    $usuarios = $result->fetch(PDO::FETCH_ASSOC);
    // VALIDA Q LA VARIABLE TENGA ALGO
    if ($usuarios) {
        $_SESSION['usuario'] = array();
        $_SESSION['usuario'][0] = $usuarios['usr_id'];
        $_SESSION['usuario'][1] = $usuarios['usuario'];
        $_SESSION['usuario'][2] = $usuarios['estado'];
        $_SESSION['usuario'][3] = $usuarios['adop'];
        $_SESSION['usuario'][4] = $usuarios['padrino'];
        $_SESSION['usuario'][5] = $usuarios['tienda'];
        $_SESSION['usuario'][6] = $usuarios['blog'];
        header("location: ../index.php");
    } else {

        echo '<meta http-equiv="refresh" content="0; url=../index.php?modulo=inicio&error=Usuario o Contraseña incorrectos" />';
        
    }
} catch (PDOException $e) {
    echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
}
?>