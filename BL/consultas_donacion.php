<?php
class Consulta_donacion
{
    public function SP_insertar_donacion($conexion,$don)
    {
        try {
            $sql = "CALL SP_insertar_donacion(:nombres, :apellidos, :correo, :celular, :vaucher, :monto)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':nombres', $don->getDona_nombres());
            $consulta->bindValue(':apellidos', $don->getDona_apellidos());
            $consulta->bindValue(':correo', $don->getDona_correo());
            $consulta->bindValue(':celular', $don->getDona_celular());
            $consulta->bindValue(':vaucher', $don->getDona_vaucher());
            $consulta->bindValue(':monto', $don->getDona_monto());
            $consulta->execute();
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    
}
?>
