<?php

class conexion
{
    static public function conectar()
    {
        $contrasena = "";
        $usuario = "root";
        $BaseDeDatos = "albergue_perritos";
        $servidor = "localhost";
        try {
            $conexion = new PDO("mysql:host=$servidor;  dbname=$BaseDeDatos", $usuario, $contrasena);
            $conexion->setAttribute(PDO::ATTR_ERRMODE,  PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
        return $conexion;
    }
}
?>