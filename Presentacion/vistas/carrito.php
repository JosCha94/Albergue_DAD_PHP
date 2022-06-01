<?php
require_once('BL/consultas_tienda.php');
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
$consulta = new Consulta_producto();

$products = $consulta->listarProductosCarrito($conexion, $_SESSION['usuario'][0]);
$categories = $consulta->listarCategorias($conexion);
$num = 1;

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
                                <th scope="row"><?php echo $num++ ?></th>
                                <td><img width="100px" src="data:image/<?php echo ($value['img_product_tipo']); ?>;base64,<?php echo base64_encode($value['img_product_foto']); ?>" alt="<?= $value['product_nombre']; ?>" class="img-fluid"></td>
                                <td><?= $value['product_nombre']; ?></td>
                                <td><?= $value['Precio']; ?></td>
                                <td><?= $value['cantidad']; ?></td>
                                <td><?= $value['Total']; ?></td>
                                <td><button class="btn btn-warning"><i class="fa-solid fa-rotate"></i></button>
                                <td><button class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></td>                                   
                            </tr> 
                            <?php $toti = $toti + $value['Total']; ?>
                            
                        <?php endforeach; ?>
                       
                    </tbody>
                </table>
                <h2>Total: S/.<?php echo $toti ?></h2>
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