<?php
class Consulta_producto{
    public function listarProductos($conexion, $productos) {
        $sql = "SELECT * FROM $productos";
        $consulta = $conexion->prepare($sql);
        $consulta->execute();
        $products = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
}
    

?>