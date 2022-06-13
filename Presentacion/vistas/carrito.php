<?php
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [3]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [3]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($permisoEsp == 'true'):
        break;
    case ($rol != 'true'):
        $error = 'No tiene activado el rol de Cliente';
        break;
    case ($permisosRol != 'true'):
        $error = 'Su rol actual no tiene permiso para acceder a esta pagina';
        break;
}
?>
<?php if ($error == 'SinError') : ?>
    <?php
    require_once('BL/consultas_usuario.php');
    require_once('BL/consultas_tienda.php');
    require_once('DAL/conexion.php');
    $conexion = conexion::conectar();
    $consulta = new Consulta_producto();
    $consulta2 = new Consulta_usuario();
    $usuario = $consulta2->detalleUsuario($conexion, $_SESSION['usuario'][0]);

    if (isset($_POST['borrarCarrito'])) {
        $idUser = $_SESSION['usuario'][0];
        $idProducto = $_POST['product_id'];
        $consulta->borrarDeCarrito($conexion, $idUser, $idProducto);
        $num = 0;
        $array = json_decode($_SESSION['usuario'][5], true);        
        foreach ($array as $key => $value) :
            if ($value['id'] == $idProducto) {
                unset($array[$key]);
            }
        endforeach;
        $_SESSION['usuario'][5] = json_encode($array);
    }

    if (isset($_POST['cambiarCantidad'])) {
        $idUser = $_SESSION['usuario'][0];
        $idProducto = $_POST['product_id'];
        $cantidad = $_POST['product_cantidad'];
        $consulta->cambiarCantidadCarrito($conexion, $idUser, $idProducto, $cantidad);
    }

    if (isset($_POST['btn-pagar'])) {
        $idUser = $_SESSION['usuario'][0];
        $consulta->cambiarCantidadProducto($conexion, $idUser);
    }

    $products = $consulta->listarProductosCarrito($conexion, $_SESSION['usuario'][0]);
    $idx = 1;
    $error = 0;
    $compra = array();




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
                                    <td><?php if ($value['cantidad'] <= $value['product_stock']) {
                                            echo $value['cantidad'];
                                        } else {
                                            $error = $errror + 1;
                                            echo $value['cantidad'], " <font color='red'>excede stock</font>";
                                        } ?></td>
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
                                <?php $total = $total + $value['Total'];
                                $resErr = $error;

                                // $compr2[]=array($value['product_id'], $_SESSION['usuario'][0],$value['cantidad']);
                                // $compra[] = array('pid' => (int)$value['product_id'], 'uid' => (int)$_SESSION['usuario'][0], 'ctd' => (int)$value['cantidad']);
                                ?>

                            <?php endforeach; ?>
                            <!-- <?php $databuy = json_encode($compra); ?> -->




                            <!-- Modal Cantidad -->
                            <?php foreach ($products as $key => $value) : ?>
                                <div class="modal fade" id="modalCantidad_<?= $value['product_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cantidad <?= $value['product_nombre']; ?></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="" method="post">
                                                <div class="modal-body">
                                                    <input type="number" name="product_cantidad" min="1" max="<?= $value['product_stock']; ?>" value="<?= $value['cantidad']; ?>">
                                                    <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
                    if ($total == '') { ?>

                        <MARQUEE SCROLLAMOUNT=10>
                            <h2>El carrito esta vacio</h2>
                        </MARQUEE>

                    <?php
                    } else { ?>
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
                            <?php if ($total == '' || $resErr != 0) { ?>
                            <?php
                            } else { ?>
                                <button type="button" class="btn btn-login btn-lg m-3" data-bs-toggle="modal" data-bs-target="#ModalCompra">Continuar compra</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <!-- Modal Compra -->
                    <div class="modal fade" id="ModalCompra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Compra electronica</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <main class="form-signin">
                                        <!-- <form action="BL/valida_user.php" method="post"> -->
                                        <div class="text-center">
                                            <img src="Presentacion/libs/images/doglogo.png" alt="logo" width="80em" class="ms-auto">
                                            <h5 class="h3 my-3 fw-normal text-center">PlanetDog SAC</h5>
                                        </div>
                                        <?php foreach ($products as $key => $value) : ?>

                                            <div class="row border border-secondary">
                                                <div class="col-6">
                                                    <img width="100px" src="data:image/<?php echo ($value['img_product_tipo']); ?>;base64,<?php echo base64_encode($value['img_product_foto']); ?>" alt="<?= $value['product_nombre']; ?>" class="img-fluid me-2">
                                                    <!-- <br> -->
                                                    <?= $value['product_nombre']; ?>
                                                    <br>
                                                    <?= $value['cantidad'], "un."; ?>
                                                </div>
                                                <div class="col-4 position-relative">
                                                    <div class="position-absolute top-50 start-50 translate-middle">
                                                        S/ <?= $value['Total']; ?>
                                                    </div>
                                                </div>
                                            </div>

                                        <?php endforeach; ?>

                                        <div class="form-floating text-end mt-2">
                                            <h2 class="me-2">Total: S/ <?php echo $total ?></h2>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="nombre" class="form-control" name="nombre" value="<?= $usuario['usr_nombre'] ?>" disabled>
                                                <label class="form-label" for="nombre">Nombres</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="text" id="apellidos" class="form-control" name="apellidos" value="<?= $usuario['usr_apellido_paterno'] . ' ' . $usuario['usr_apellido_materno'] ?> " disabled>
                                                <label class="form-label" for="apellidos">Apellidos</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" id="correo" class="form-control" name="correo" value="<?= $usuario['usr_email'] ?>" disabled>
                                                <label class="form-label" for="correo">Correo electrónico</label>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-2">
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="tel" id="celu" class="form-control" name="celu" value="<?= $usuario['usr_celular'] ?>" disabled>
                                                <label class="form-label" for="celu">Teléfono</label>
                                            </div>
                                        </div>
                                        <form action="" method="post">
                                            <div class="d-flex flex-row align-items-center mb-2">
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="tel" id="dni" class="form-control" placeholder="Ingrese su número de DNI" name="dni" pattern="[0-9]{8}" title="El formato del DNI no es el correcto" value="" required>
                                                    <label class="form-label" for="dni">DNI</label>
                                                </div>
                                            </div>

                                            <!-- </form> -->
                                    </main>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-login" name="btn-pagar">Pagar</a>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>

    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>

<?php endif; ?>