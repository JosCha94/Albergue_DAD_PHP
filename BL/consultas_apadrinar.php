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

    public function listarTipoSuscrip($conexion) {
        try{
            $sql = "CALL SP_mostrar_tipoSucripcion()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $susTipo = $consulta->fetchall(PDO::FETCH_ASSOC);
            return $susTipo;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function listarTipoSuscrip_id($conexion,$id) {
        try{
            $sql = "CALL SP_mostrarSuscripciones_id($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $susTipoid = $consulta->fetch(PDO::FETCH_ASSOC);
            return $susTipoid;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }




}




?>