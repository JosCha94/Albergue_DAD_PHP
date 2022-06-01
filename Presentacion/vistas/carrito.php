<?php
require_once('BL/consultas_tienda.php');
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
$consulta = new Consulta_producto();

if (isset($_POST['borrarCarrito'])) {
    $idUser = $_SESSION['usuario'][0];
    $idProducto = $_POST['product_id'];
    $consulta->borrarDeCarrito($conexion, $idUser, $idProducto);
}

if(isset($_POST['cambiarCantidad'])){
    $idUser = $_SESSION['usuario'][0];
    $idProducto = $_POST['product_id'];
    $cantidad = $_POST['product_cantidad'];
    $consulta->cambiarCantidadCarrito($conexion, $idUser, $idProducto, $cantidad);
 }

$products = $consulta->listarProductosCarrito($conexion, $_SESSION['usuario'][0]);
$categories = $consulta->listarCategorias($conexion);
$idx = 1;

?>
<div class="container adop-body mt-5">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <!-- productos -->
            <h2 class="text-center">Carrito de compras</h2>
            <div class="wrapper-gallery row magnific-popup mt-5">
                <!-- producto -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">IMG</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Subtotal</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $key => $value) : ?>
                            <tr>
                                <th scope="row"><?php echo $idx++ ?></th>
                                <td><img width="100px" src="data:image/<?php echo ($value['img_product_tipo']); ?>;base64,<?php echo base64_encode($value['img_product_foto']); ?>" alt="<?= $value['product_nombre']; ?>" class="img-fluid"></td>
                                <td><?= $value['product_nombre']; ?></td>
                                <td>S/ <?= $value['Precio']; ?></td>
                                <!-- <td><?php echo $value['product_stock']; ?></td> -->
                                <td><?= $value['cantidad']; ?></td>
                                <td>S/ <?= $value['Total']; ?></td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button class="btn btn-warning me-1" title="Cambiar cantidad" data-bs-toggle="modal" data-bs-target="#modalCantidad_<?= $value['product_id']; ?>">
                                            <i class="fa-solid fa-rotate"></i>
                                        </button>
                                        <form action="" method="post">
                                            <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                                            <button class="btn btn-danger" name="borrarCarrito" title="Eliminar del carrito"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php $total = $total + $value['Total']; ?>

                        <?php endforeach; ?>
                        <!-- Modal -->
                        <?php foreach ($products as $key => $value) : ?>
                            <div class="modal fade" id="modalCantidad_<?= $value['product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel"><?= $value['product_nombre']; ?> Cantidad</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="" method="post">
                                            <div class="modal-body">
                                                <input type="number" name="product_cantidad" min="1" max="<?= $value['product_stock']; ?>" value="<?= $value['cantidad']; ?>">
                                                <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="cambiarCantidad">Cambiar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- -----EndModal--------- -->

                    </tbody>
                </table>
                <?php
                if($total==''){?>

                <MARQUEE SCROLLAMOUNT=10><h2>El carrito esta vacio</h2></MARQUEE>
                    
                <?php 
                }else{?>
                    <h2>Total: S/ <?php echo $total ?></h2>
                <?php
                }
                ?>
    
            </div>
            <!-- END CARD -->
            <div class="row sorting mb-5 mt-5">
                <div class="col-8">
                    <a class="btn btn-light scroll_up"><i class="fas fa-arrow-up mr-2 scroll_up"></i> Regresar</a>
                </div>
                <div class="col-4">
                    <div class="dropdown float-md-right">
                        <label class="mr-2">View:</label>
                        <a class="btn btn-light btn-lg dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">12 <span class="caret"></span></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">12</a>
                            <a class="dropdown-item" href="#">24</a>
                            <a class="dropdown-item" href="#">48</a>
                            <a class="dropdown-item" href="#">96</a>
                        </div>
                        <div class="btn-group float-md-right ml-3">
                            <button type="button" class="btn btn-lg btn-light"> <span class="fa fa-arrow-left"></span> </button>
                            <button type="button" class="btn btn-lg btn-light"> <span class="fa fa-arrow-right"></span> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>