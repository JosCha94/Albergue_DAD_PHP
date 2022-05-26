<?php
require_once('DAL/conexion.php');
require_once('BL/consultas_tienda.php');
$conexion = conexion::conectar();
$consulta = new Consulta_producto();
$id = $_GET['id'];
$product = $consulta->detalleProducto($conexion, $id);
?>
<div class="container margin1 mt-5">
    <div class="row">
        <div class="col-md-5">
            <img src="Presentacion/libs/images/perro1.jpg" class="img-fluid" alt="Perro adopcion">
        </div>
        <div class="col-md-7 res-margin">
            <div class="pet-adopt-info">
                <h2><?= $product['product_nombre']; ?></h2>
                <p><?= $product['product_descripcion']; ?>
                </p>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item "><strong>Producto:</strong>  <?= $product['product_nombre']; ?> </li>
                    <?php
                    $tamano = $product['product_size_perro']; ?>
                    <li class="list-group-item "><strong>Para perritos de tamaño:</strong> <?php echo ($tamano == 'Pequeno') ? "Pequeño" : "$tamano"; ?></li>
                    <li class="list-group-item "><strong>Precio:</strong> <?= $product['product_precio']; ?></li>
                    <li class="list-group-item "><strong>IGV:</strong> <?= $product['product_igv']; ?></li>
                    <li class="list-group-item "><strong>Stock disponible:</strong> <?= $product['product_stock']; ?></li>
                </ul>
                <div class="mt-3 d-flex justify-content-around">
                    <a href="#" class="btn btn-adopt mt-5">¡Añadir al Carrito!</a>
                    <a href="index.php?modulo=tienda" class="btn btn-danger mt-5 ">Volver</a>
                </div>
                <div class="row">

                </div>
            </div>
        </div>
        <!-- /col-md-7-->
    </div>
    <!-- /row -->
</div>