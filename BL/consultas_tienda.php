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
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br> Ocurrió un ERROR con la base de datos y no se puede mostrar los productos

            </div>

        <?php
        }
    }

    public function listarCategorias($conexion)
    {
        try {
            $sql = "CALL SP_select_categorias()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $categorias = $consulta->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $categorias = 'falloCatego';
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br> Ocurrió un ERROR y no se puede mostrar los filtros

            </div>

        <?php
        }
        return $categorias;
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
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br> Ocurrió un ERROR con la base de datos y no se puede mostrar los detalles del producto

            </div>

        <?php
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
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br> Ocurrió un ERROR con la base de datos y no se puede mostrar todas las imagenes del producto

            </div>

        <?php
        }
    }

    // -------------------------------------------------
    //                    CARRITO
    // --------------------------------------------------

    public function validarProductosCarrito($idProducto, $carrito)
    {
        try {
            $carro = $carrito;
            $array = json_decode($carro, true);
            foreach ($array as $key => $value) :
                if (in_array($value['id'], [$idProducto])) {
                    $res = 'true';
                }
            endforeach;

            return $res;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    public function agregarProductoAlCarrito($bd, $idUser, $idProducto, $cantidad)
    {
        try {
            $sql = "CALL SP_agregar_al_carrito($idUser,$idProducto,$cantidad)";
            $consulta = $bd->prepare($sql);
            $consulta->execute();
            $product = $consulta->fetch(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $product = 'errorAdd';
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br> Ocurrió un ERROR, no se ha podido agregar el producto al carrito

            </div>

<?php
        }
        return $product;
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
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Ocurrió un ERROR con la base de datos y no se ha podido mostrar los productos en su carrito

            </div>

<?php
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
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            $products='fallo';
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <strong class="fs-3">Error!</strong><br> Ocurrió un ERROR y no es posible eliminar el producto de su carrito por el momento
            </div>

<?php
        }
        return $products;
    }

    public function cambiarCantidadCarrito($bd, $idUser, $idProducto, $cantidad)
    {
        try {
            $sql = "CALL SP_update_carrito($idUser,$idProducto,$cantidad)";
            $consulta = $bd->prepare($sql);
            $consulta->execute();
            $product = $consulta->fetch(PDO::FETCH_ASSOC);
            return $product;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
            <strong class="fs-3">Error!</strong><br> Ocurrió un ERROR y no es posible cambiar la cantidad del producto en su carrito por el momento
            </div>

<?php
        }
    }

    // -------------------------------------------------
    //                    COMPRA
    // --------------------------------------------------

    public function pedidoTienda($bd, $pedido)
    {
        try {

            $sql = "CALL SP_pedido_tienda(:idUser, :idRol, :cliente, :dni, :correo, :monto, :igv, @DATA)";
            $consulta = $bd->prepare($sql);
            $consulta->bindParam(':idUser', $pedido->getUsr_id());
            $consulta->bindParam(':idRol', $pedido->getRol_id());
            $consulta->bindParam(':cliente', $pedido->getCliente());
            $consulta->bindParam(':dni', $pedido->getDni());
            $consulta->bindParam(':correo', $pedido->getCorreo());
            $consulta->bindParam(':monto', $pedido->getTotal());
            $consulta->bindParam(':igv', $pedido->getIgv());

            $consulta->execute();
            $consulta->closeCursor();
            $consulta = $bd->prepare("SELECT @DATA AS id");
            $consulta->execute();
            $id = $consulta->fetch(PDO::FETCH_ASSOC);
            return $id['id'];
        } catch (PDOException $e) {

            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }

    // ---------------------------------------
    //          ADMIN RECOJO COMPRA
    // ----------------------------------------

    public function listarVentasSinRecoger($conexion)
    {
        try {
            $sql = "CALL SP_pedidos_sinRecoger()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar las ventas

            </div>

<?php
        }
    }

    public function pedido_recogido($conexion, $Pid)
    {
        try {
            $sql = "CALL SP_update_pedido_recogido($Pid)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Devido a un error en la base de datos, no se pudo cambiar el estado del pedido
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function detalleCompra($conexion, $pid)
    {
        try {
            $sql = "CALL SP_detalle_compra($pid)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            //   echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong class="fs-3">Error!</strong><br>Debido a un problema, por el momento no se puede listar las ventas

            </div>

<?php
        }
    }

}
