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

    public function insetar_post($conexion, $post, $usu, $coment)
    {
        try {
            $sql = "CALL SP_insertar_comentario_post($post, $usu, :comentario, @DATA)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':comentario', $coment);
            $consulta->execute();
            $consulta->closeCursor();
            $consulta = $conexion->prepare("SELECT @DATA AS rpost");
            $consulta->execute();
            $res = $consulta->fetch(PDO::FETCH_ASSOC);
            return $res['rpost'];

        } catch (PDOException $e) {
             echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                 <div class="alert alert-danger alert-dismissible fade show " role="alert">
                     <strong>Error!</strong> No se pudo agregar el comentario.
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             <?php        
        }
        
    }

    public function listarComentariosPost($conexion, $postId)
    {
        try {
            $sql = "CALL SP_select_comentarios_postid($postId)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $post = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $post;
        } catch (PDOException $e)  {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                 <div class="alert alert-danger alert-dismissible fade show " role="alert">
                     <strong>Error!</strong> No se pudo mostrar los comentarios del post.
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             <?php  
        }
    }
}
?>