<?php
class Consulta_producto{
    public function listarProductos($conexion) {
        try{
            $sql = "CALL SP_select_productos()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $products = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function listarCategorias($conexion) {
        try{
            $sql = "CALL SP_select_categorias()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $categorias;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }

    }

    public function detalleProducto($conexion, $id) {
        try{
            $sql = "CALL SP_detalle_producto($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $product = $consulta->fetch(PDO::FETCH_ASSOC);
            return $product;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function listarImgProducto($conexion, $id) {
        try{
            $sql = "CALL SP_select_imgsproducto($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $imgproduct = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $imgproduct;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }

    }
}
    

?>

     <!-- public function listarProductos($conexion) {
         // $sql = "SELECT * FROM $productos";
             $sql = "CALL SP_listar_productos()";
             $resultado = $conexion->query($sql);
             $productos = $resultado->fetchAll(PDO::FETCH_ASSOC);
             return $productos;

         } -->
    
    <!-- public function listarCategorias($conexion) {
         // $sql = "CALL SP_select_categorias()";
        // $consulta = $conexion->prepare($sql);
        // $consulta->execute();
        // $categories = $consulta->fetchAll(PDO::FETCH_ASSOC);
        // return $categories;
    } -->

    