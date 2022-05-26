<?php
class Consulta_usuario
{
    public function insetar_usuario($conexion,$usu)
    {
        try {
            $sql = "CALL SP_insertar_usuario(:usuario, :clave, :nombre, :ape_pat, :ape_mat, :email, :celular)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':usuario', $usu->getUsuario());
            $consulta->bindValue(':clave', $usu->getUsr_clave());
            $consulta->bindValue(':nombre', $usu->getUsr_nombre());
            $consulta->bindValue(':ape_pat', $usu->getUsr_apellido_paterno());
            $consulta->bindValue(':ape_mat', $usu->getUsr_apellido_materno());
            $consulta->bindValue(':email', $usu->getUsr_email());
            $consulta->bindValue(':celular', $usu->getUsr_celular());
            $consulta->execute();
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }
}
?>
