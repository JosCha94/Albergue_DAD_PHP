<?php
class Consulta_adopcion{
    //Muestra todos los datos de los perritos
    public function listarPerro($conexion, $id) {
        try{
            $sql = "CALL SP_buscar_perro($id)";
            // $sql = "SELECT * FROM perritos where perro_id = $id";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $perro = $consulta->fetch(PDO::FETCH_ASSOC);
            return $perro;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong><br> Debido a un error no se ha podido mostrar los perritos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php     
        }
    }
    //Muestra todas las fotos de cada uno de los perros
    public function listarImagen_perro($conexion) {
        try{
            $sql = "CALL SP_mostrar_image_perro_portada()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $img_perro = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $img_perro;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong><br> Hubo un error y no se ha podido mostrar las fotos de los perritos
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php     
        }
    }
    public function buscarImagen_perro($conexion, $id) {
        try{
            $sql = "CALL SP_listar_img_byId($id)";
            // $sql = "SELECT img_perro_foto from img_perritos where perro_id = $id";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $img_perro = $consulta->fetchall(PDO::FETCH_ASSOC);
            return $img_perro;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong><br> Un error ha evitado que se puedan mostrar las imagenes de los perritos.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php     
        }

    }
    public function mostarImagenes_perro($conexion, $id) {
        try{
            $sql = "CALL SP_buscar_img_perrito($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $img_perro = $consulta->fetch(PDO::FETCH_ASSOC);
            return $img_perro;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong><br> No se ha podido encontrar las imagenes que estaba buscando.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php     

        }

    }

    // public function insertarForm_adopcion($conexion, $adop)
    // {
    //     try {
    //         $sql = "CALL SP_insert_formulario_adopcion(:idUsuario, :idPerro, :razonAdo)";
    //         $consulta = $conexion->prepare($sql);
    //         $consulta -> bindValue(':idUsuario', $adop->getUsr_id());
    //         $consulta -> bindValue(':idPerro', $adop->getPerro_id());
    //         $consulta -> bindValue(':razonAdo', $adop->getAdop_razon());
    //         $consulta -> execute();
    //     }catch (PDOExeption $e){
    //        echo "Ocurrio un error en la base de atos: " . $e -> getMessage();
    //     }
        
    // }

    public function insertarForm_adopcion($conexion, $adop)
    {
        try {
            $sql = "CALL SP_insert_formAdopcion(:idUsuario, :rolId,  :idPerro, :adopDueno, :razonAdo, @DATA)";
            $consulta = $conexion->prepare($sql);
            $consulta -> bindValue(':idUsuario', $adop->getUsr_id());
            $consulta -> bindValue(':rolId', $adop->getRol_id());
            $consulta -> bindValue(':idPerro', $adop->getPerro_id());
            $consulta -> bindValue(':adopDueno', $adop->getAdop_dueno());
            $consulta -> bindValue(':razonAdo', $adop->getAdop_razon());
            $consulta -> execute();

            $consulta ->closeCursor();
            $consulta = $conexion->prepare("SELECT @DATA AS rnum");
            $consulta->execute();
            $resnum = $consulta->fetch(PDO::FETCH_ASSOC);
            $resultado = $resnum['rnum'];
            
        }catch (PDOException $e){
            // echo "Ocurrio un error en la base de atos: " . $e -> getMessage();

            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong><br> Ocurrió algo y no se ha podido procesar la informacion de la solicitud.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php     
            $resultado = "Falló";
        }
        return $resultado;
    } 

    public function mostrarUsuario_adopcion($conexion, $id) {
        try{
            $sql = "CALL SP_select_userAdopcion($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $usr_adop = $consulta->fetch(PDO::FETCH_ASSOC);
            return $usr_adop;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong><br> No se ha podido mostrar la información solicitada
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php     
        }
    }

        
}
    

?>
