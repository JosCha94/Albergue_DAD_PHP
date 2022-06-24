<?php
class Consulta_pedido
{
    public function select_pedidos($conexion, $uid)
    {
        try {
            $sql = "CALL SP_select_pedidos_id($uid)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pedido = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $pedido;

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Devido a un error en la base de datos, no se pudo mostrar sus pedidos
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
        }        
    }

    public function select_pedido($conexion, $pid)
    {
        try {
            $sql = "CALL SP_select_pedido_id($pid)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pedido = $consulta->fetch(PDO::FETCH_ASSOC);
            return $pedido;

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Devido a un error en la base de datos, no se pudo mostrar el voucher
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
        }        
    }

    public function select_detallePedido_id($conexion, $pid)
    {
        try {
            $sql = "CALL SP_select_detallePedido_id($pid)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $pedido = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $pedido;

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Devido a un error en la base de datos, no se pudo mostrar el voucher
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
        }        
    }
}
?>