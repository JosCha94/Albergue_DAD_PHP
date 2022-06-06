<?php

class Consulta_apadrinar
{

    public function mostarSuscripciones($conexion)
    {
        try {
            $sql = "CALL SP_mostrarSuscripciones()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $sus = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $sus;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }
}




?>