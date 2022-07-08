<?php
class Consulta_post
{
    public function listarPost($conexion)
    {
        try {
            $sql = "CALL SP_listar_posts()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $post = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $post;
        } catch (PDOException $e)  {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function mostrarPost($conexion,$id) {
        try{
            $sql = "CALL SP_select_post_id_admin($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $postId = $consulta->fetch(PDO::FETCH_ASSOC);
            return $postId;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }
}
?>