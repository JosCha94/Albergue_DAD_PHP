<?php
class Consulta_producto{
    public function listarProductos($conexion) {
        // $sql = "SELECT * FROM $productos";
        $sql = "CALL SP_select_productos()";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $products = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

    public function listarCategorias($conexion) {
        $sql = "CALL SP_select_categorias()";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $categories = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $categories;
    }
}
    

?>