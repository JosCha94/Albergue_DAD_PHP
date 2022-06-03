<?php
class Consulta_producto
{
    public function listarProductos($conexion)
    {
        try {
            $sql = "CALL SP_select_productos()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $products = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function listarCategorias($conexion)
    {
        try {
            $sql = "CALL SP_select_categorias()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $categorias;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function detalleProducto($conexion, $id)
    {
        try {
            $sql = "CALL SP_detalle_producto($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $product = $consulta->fetch(PDO::FETCH_ASSOC);
            return $product;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function listarImgProducto($conexion, $id)
    {
        try {
            $sql = "CALL SP_select_imgsproducto($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $imgproduct = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $imgproduct;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    // -------------------------------------------------
    //                    CARRITO
    // --------------------------------------------------

    public function agregarProductoAlCarrito($bd,$idUser,$idProducto,$cantidad)
    {
        try {
            $sql = "CALL SP_agregar_al_carrito($idUser,$idProducto,$cantidad)";
            $consulta = $bd->prepare($sql);
            $consulta->execute();
            $product = $consulta->fetch(PDO::FETCH_ASSOC);
            return $product;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function listarProductosCarrito($conexion, $id)
    {
        try {
            $sql = "CALL SP_select_productos_carrito($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $products = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function borrarDeCarrito($conexion, $idUser, $idProduct)
    {
        try {
            $sql = "CALL SP_eliminar_producto_carrito($idUser, $idProduct)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $products = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $products;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function cambiarCantidadCarrito($bd,$idUser,$idProducto,$cantidad)
    {
        try {
            $sql = "CALL SP_update_carrito($idUser,$idProducto,$cantidad)";
            $consulta = $bd->prepare($sql);
            $consulta->execute();
            $product = $consulta->fetch(PDO::FETCH_ASSOC);
            return $product;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }


}


?>
