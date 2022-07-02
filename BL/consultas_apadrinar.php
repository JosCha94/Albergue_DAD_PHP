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

    public function datosUsuario_apadrinar($conexion, $id) {
        try{
            $sql = "CALL SP_select_userAdopcion($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $usr_adop = $consulta->fetch(PDO::FETCH_ASSOC);
            return $usr_adop;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function insertar_Suscripcion($conexion, $suscri, $monto, $cvc, $fechaTar, $numTar, $nameTar)
    {
        try {
            $sql = "CALL SP_insert_suscrip_tarjeta(:idUsuario, :rolId,  :idTipoSus, :tiempoSus, :monto, :cvc, :fechaTar, :numtar, :nameTar, @DATA)";
            $consulta = $conexion->prepare($sql);
            $consulta -> bindValue(':idUsuario', $suscri->getUsr_id());
            $consulta -> bindValue(':rolId', $suscri->getRol_id());
            $consulta -> bindValue(':idTipoSus', $suscri->getTipo_id());
            $consulta -> bindValue(':tiempoSus', $suscri->getSuscrip_tiempo());
            $consulta -> bindParam(':monto', $monto);
            $consulta -> bindParam(':cvc', $cvc);
            $consulta -> bindParam(':fechaTar', $fechaTar);
            $consulta -> bindParam(':numtar', $numTar);
            $consulta -> bindParam(':nameTar', $nameTar);

            $consulta -> execute();
            $consulta -> closeCursor();
            $consulta = $conexion -> prepare("SELECT @DATA AS id");
            $consulta -> execute();
            $id = $consulta ->fetch(PDO::FETCH_ASSOC);
            return $id['id'];
        }catch (PDOException $e){

            echo "Ocurrio un error en la base de datos: " . $e -> getMessage();
        }
    } 


    




}




?>