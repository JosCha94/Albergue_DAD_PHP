<?php
require_once('DAL/conexion.php');
require_once('BL/consultas_tienda.php');
$conexion = conexion::conectar();
$consulta = new Consulta_producto();
$id = $_GET['id'];
$product = $consulta->detalleProducto($conexion, $id);
$imgproduct = $consulta->listarImgProducto($conexion, $id);

if (isset($_POST['carrito'])) {
    $idUser = $_SESSION['usuario'][0];
    $idProducto = $id;
    $cantidad = $_POST['cantidad'];

    $res = $consulta->validarProductosCarrito($idProducto, $_SESSION['usuario'][5]);

    if ($res != 'true') {
        $Carrito = $_SESSION['usuario'][5];
        $array = json_decode($Carrito, true);
        $prodt = ['id' => (int)$idProducto];
        array_push($array, $prodt);
        $_SESSION['usuario'][5] = json_encode($array);
        $consulta->agregarProductoAlCarrito($conexion, $idUser, $idProducto, $cantidad);
    }
}
?>
<div class="container margin1 mt-5">
    <div class="row">
        <div class="col-md-5">
            <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="data:image/<?php echo ($product['img_product_tipo']); ?>;base64,<?php echo base64_encode($product['img_product_foto']); ?>" class="d-block w-100" alt="<?= $product['product_nombre']; ?>">
                    </div>
                    <?php foreach ($imgproduct as $key => $value) : ?>
                        <div class="carousel-item">
                            <img src="data:image/<?php echo ($value['img_product_tipo']); ?>;base64,<?php echo base64_encode($value['img_product_foto']); ?>" class="d-block w-100" alt="<?= $value['img_product_nombre']; ?>">
                        </div>
                    <?php endforeach; ?>

                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <div class="col-md-7 res-margin">
            <div class="pet-adopt-info">
                <h2><?= $product['product_nombre']; ?></h2>
                <p><?= $product['product_descripcion']; ?>
                </p>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item "><strong>Producto:</strong> <?= $product['product_nombre']; ?> </li>
                    <?php
                    $tamano = $product['product_size_perro']; ?>
                    <li class="list-group-item "><strong>Para perritos de tamaño:</strong> <?php echo ($tamano == 'Pequeno') ? "Pequeño" : "$tamano"; ?></li>
                    <li class="list-group-item "><strong>Precio:</strong> <?= $product['product_precio']; ?></li>
                    <li class="list-group-item "><strong>Stock disponible:</strong> <?= $product['product_stock']; ?></li>
                </ul>
                <div class="mt-3 d-flex justify-content-around">
                    <?php if ($logueado == 'false') {
                    } else { ?>

                        <div class="row">
                            <form action="" method="post" id="detail_producto" name="detail_producto" class="mt-5">
                                <input type="number" name="cantidad" min="1" max="<?= $product['product_stock']; ?>" value="1">
                                <input type="hidden" name="product_id" value="<?= $product['product_id']; ?>">
  
                                <?php if ($consulta->validarProductosCarrito($product['product_id'], $_SESSION['usuario'][5])) : ?>
                                    <button class="btn btn-adopt" name="" disabled>Producto añadido al carrito</button>
                                    <?php else : ?>
                                    <button class="btn btn-adopt" name="carrito">¡Añadir al Carrito!</button>
                                <?php endif; ?>
  
                                    
                            </form>
                        </div>    
                        <?php } ?>

                        
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