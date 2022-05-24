<?php
class Consulta_perro{
    //Muestra todos los datos de los perritos
    public function listarPerro($conexion) {
        try{
            $sql = "CALL SP_buscar_perro()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $perro = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $perro;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
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
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }

    }
}
    

?>
