<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [3]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [3]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($permisoEsp == 'true'):
        break;
    case ($rolActual == ' '):
        $error = 'No tiene un rol activado';
        break;
    case ($permisosRol != 'true'):
        $error = 'Su rol actual no tiene permiso para acceder a esta pagina';
        break;
}
?>
<?php if ($error == 'SinError') : ?>
    <?php

    require_once('BL/phpmailer/Exception.php');
    require_once('BL/phpmailer/PHPMailer.php');
    require_once('BL/phpmailer/SMTP.php');

    require_once 'ENTIDADES/pedido.php';
    require_once('BL/consultas_usuario.php');
    require_once('BL/consultas_tienda.php');
    require_once('DAL/conexion.php');
    $conexion = conexion::conectar();
    $consulta = new Consulta_producto();
    $consulta2 = new Consulta_usuario();
    $usuario = $consulta2->detalleUsuario($conexion, $_SESSION['usuario'][0]);

    $igv = 0.18;


    if (isset($_POST['borrarCarrito'])) {
        $idUser = $_SESSION['usuario'][0];
        $idProducto = $_POST['product_id'];
        $deleteCar = $consulta->borrarDeCarrito($conexion, $idUser, $idProducto);
        $num = 0;
        $array = json_decode($_SESSION['usuario'][5], true);
        foreach ($array as $key => $value) :
            if ($value['id'] == $idProducto) {
                unset($array[$key]);
            }
        endforeach;
        if ($deleteCar != 'fallo') {
            $_SESSION['usuario'][5] = json_encode($array);
        }
    }

    if (isset($_POST['cambiarCantidad'])) {
        $idUser = $_SESSION['usuario'][0];
        $idProducto = $_POST['product_id'];
        $cantidad = $_POST['product_cantidad'];
        $consulta->cambiarCantidadCarrito($conexion, $idUser, $idProducto, $cantidad);
    }

    if (isset($_POST['btn-pagar'])) {
        $idUser = $_SESSION['usuario'][0];
        $idRol =  $rolActual;
        $cliente = $usuario['usr_nombre'] . ' ' . $usuario['usr_apellido_paterno'] . ' ' . $usuario['usr_apellido_materno'];
        $dni = $_POST['dni'];
        $correo = $usuario['usr_email'];
        $montoTotal = $_POST['total'];
        $IGV = $_POST['igv'];
        $cvc = (int)$_POST['cvc'];
        $fechaTar = $_POST['fechaTar'];
        $numTar = (int)$_POST['numTar'];
        $nameTar = $_POST['nameTar'];
        $DateAndTime = date('m-d-Y h:i:s a', time());
        $pedido = new Pedido($idUser, $idRol, $cliente, $dni, $correo, $montoTotal, $IGV);
        $resVali = $consulta->validarTarjeta($conexion, $cvc, $fechaTar, $numTar, $nameTar);
        if ($resVali == 0) {
            $resPedi = $consulta->pedidoTienda($conexion, $pedido, $cvc, $fechaTar, $numTar, $nameTar);
            if ($resPedi == 1) {
                $_SESSION['usuario'][5] = json_encode(array());
                echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=carrito&mensaje=Se ejecuto correctamente la compra" />';
                $asunto = "Compra realizada en la tienda del albergue Planet Dog";

                $body = "Hola <strong>".$cliente."</strong>, has hecho una compra en la tienda del albergue por un total de <strong>S/".$montoTotal."</strong>. El dia <strong>".$DateAndTime."</strong>, ingresa a tu cuenta del albergue para verificar los detalles de tu compra , recuerda que debes presentar el voucher de tu compra al momento de recoger tu compra en la tienda del albergue.";

                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = "0";                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';'smtp.live.com';'smtp-mail.outlook.com';               //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'albergue.adoptar.perritos@gmail.com';                     //SMTP username
                    $mail->Password   = 'iolsqknvqrlvoijr';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            
                    //Recipients
                    $mail->setFrom('albergue.adoptar.perritos@gmail.com', "ALBERGUE DE PERRITOS");
                    $mail->addAddress($correo, $cliente);     //Add a recipient
            
                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $asunto;
                    $mail->Body    = $body;
                    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            
                    $mail->send();
                    echo 'El correo se mando correctamente';
                } catch (Exception $e) {
                    echo "Hubo un error al momento de enviar el correo: {$mail->ErrorInfo}";
                }
            } elseif ($resPedi == 2) {
                echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=carrito&error=No se pudo realizar la compra debido a falta de saldo en la Tarjeta" />';
            } else {
                echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=carrito&error=No se pudo realizar la compra" />';
            }
        } elseif ($resVali == 1) {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=carrito&error=La fecha de vencimiento no coincide con la de la tarjeta o no la ha ingresado con el formato correcto" />';
        } elseif ($resVali == 2) {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=carrito&error=El código de verificación de la tarjeta CVC no es el correcto" />';
        } elseif ($resVali == 3) {
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=carrito&error=Esa tarjeta no existe, verifique los datos de su tarjeta " />';
        }
    }

    $products = $consulta->listarProductosCarrito($conexion, $_SESSION['usuario'][0]);
    $idx = 1;
    $error = 0;

    ?>
    <div class="container adop-body  my-5 bg-secondary bg-opacity-25 shadow-lg">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <!-- productos -->
                <h2 class="text-center my-5">Carrito de compras</h2>
                <div class="wrapper-gallery row magnific-popup mt-5">
                    <div class="d-block d-md-none mb-4">
                        <?php foreach ($products as $key => $value) : ?>
                            <div class="card mx-auto border border-secondary m-1" style="width: 18rem;">
                                <img width="150px" src="data:image/<?php echo ($value['img_product_tipo']); ?>;base64,<?php echo base64_encode($value['img_product_foto']); ?>" alt="<?= $value['product_nombre']; ?>" class="img-fluid">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $value['product_nombre']; ?></h5>
                                    <h6>S/ <?= $value['product_precio']; ?></h6>
                                    <p class="card-text">Cantidad: <?php if ($value['cantidad'] <= $value['product_stock']) {
                                                                        echo $value['cantidad'];
                                                                    } else {
                                                                        $error = $errror + 1;
                                                                        echo $value['cantidad'], " <font color='red'>excede stock</font>";
                                                                    } ?></p>
                                    <p class="card-text">Subtotal: S/ <?= $value['Total']; ?></p>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-warning me-1 w-100 my-2" title="Cambiar cantidad" data-bs-toggle="modal" data-bs-target="#modalCantidad_<?= $value['product_id']; ?>">
                                                <i class="fa-solid fa-rotate"></i>
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <form action="" method="post">
                                                <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                                                <button class="btn btn-danger w-100" name="borrarCarrito" title="Eliminar del carrito"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- producto -->
                    <div class="d-none d-md-block">
                        <table class="table">
                            <thead>
                                <tr class="cart">
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
                                        <td>S/ <?= $value['product_precio']; ?></td>
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
                                    <?php
                                    $total = $total + $value['Total'];
                                    $resErr = $error;
                                    ?>

                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div>
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
                                <button type="button" class="btn btn-login btn-lg" data-bs-toggle="modal" data-bs-target="#ModalCompra">Comprar</button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
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
                    <!-- Modal Compra -->
                    <div class="modal fade" id="ModalCompra" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <!-- <form> -->
                                <form action="" method="post">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Compra electronica</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <main class="form-compra">
                                            <div class="text-center">
                                                <img src="Presentacion/libs/images/doglogo.png" alt="logo" width="80em" class="ms-auto">
                                                <h5 class="h3 my-3 fw-normal text-center">PlanetDog SAC</h5>
                                            </div>
                                            <div class="mx-0 mx-md-5">
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

                                                <div class="d-flex justify-content-between mt-2">
                                                    <p>IGV: <?php echo ($igvPedi = $igv * $total) ?></p>

                                                    <h2 class="me-2">Total: S/ <?php echo ($total = $igvPedi + $total) ?></h2>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-6 mt-2">

                                                    <span id="sus-title">Datos del cliente</span>
                                                    <div class="card card-sus">
                                                        <div class="accordion" id="accordionExample">
                                                            <div class="card">
                                                                <div class="card-header p-0" id="headingTwo">
                                                                    <h2 class="mb-0">
                                                                        <button class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                            <div class="d-flex align-items-center justify-content-between">
                                                                                <span>Paypal</span>
                                                                                <img src="https://i.imgur.com/7kQEsHU.png" width="30">
                                                                            </div>
                                                                        </button>
                                                                    </h2>
                                                                </div>
                                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                                    <div class="card-body payment-card-body">
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
                                                                                <input type="tel" id="dni" class="form-control" placeholder="Ingrese su número de DNI" name="dni" pattern="[0-9]{8}" title="El formato del DNI no es el correcto" value="" required>
                                                                                <label class="form-label" for="dni">DNI</label>
                                                                            </div>
                                                                        </div>
                                                                        <input type="hidden" name="igv" value="<?= $igvPedi ?>">
                                                                        <input type="hidden" name="total" value="<?= $total ?>">

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6 mt-2">
                                                    <span id="sus-title">Método de pago</span>
                                                    <div class="card card-sus">
                                                        <div class="accordion" id="accordionExample">
                                                            <div class="card">
                                                                <div class="card-header mb-1 p-0" id="headingTwo">
                                                                    <h2 class="mb-0">
                                                                        <button class="btn btn-light btn-block text-left collapsed p-3 rounded-0 border-bottom-custom" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                            <div class="d-flex align-items-center justify-content-between">
                                                                                <span>Paypal</span>
                                                                                <img src="https://i.imgur.com/7kQEsHU.png" width="30">
                                                                            </div>
                                                                        </button>
                                                                    </h2>
                                                                </div>
                                                                <div class="card-header p-0">
                                                                    <h2 class="mb-0">
                                                                        <button class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                            <div class="d-flex align-items-center justify-content-between">
                                                                                <span>Tarjetas de crédito aceptadas</span>
                                                                                <div class="icons">
                                                                                    <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                                                                    <img src="https://i.imgur.com/W1vtnOV.png" width="30">
                                                                                    <img src="https://i.imgur.com/35tC99g.png" width="30">
                                                                                    <img src="https://i.imgur.com/2ISgYja.png" width="30">
                                                                                </div>
                                                                            </div>
                                                                        </button>
                                                                    </h2>
                                                                </div>
                                                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                                    <div class="card-body payment-card-body">
                                                                        <div>
                                                                            <span class="font-weight-normal card-text">Nombre del Titular</span>
                                                                            <div class="input">
                                                                                <input type="text" class="form-control" name="nameTar" placeholder="Como aparece en la tarjeta">
                                                                            </div>
                                                                        </div>
                                                                        <div class="mt-2">
                                                                            <span class="font-weight-normal card-text">Número de tarjeta</span>
                                                                            <div class="input">
                                                                                <input type="text" class="form-control" name="numTar" placeholder="0000 0000 0000 0000">
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-3 mb-3">
                                                                            <div class="col-md-6">
                                                                                <span class="font-weight-normal card-text">fecha de expiracion</span>
                                                                                <div class="input">
                                                                                    <i class="fa fa-calendar"></i>
                                                                                    <input type="text" class="form-control" name="fechaTar" placeholder="MM/YY">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <span class="font-weight-normal card-text">CVC/CVV</span>
                                                                                <div class="input">
                                                                                    <i class="fa fa-lock"></i>
                                                                                    <input type="text" class="form-control" name="cvc" placeholder="000">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Tu transaccion es segura con nuestros certificados SSL</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </main>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-login" name="btn-pagar">Pagar</a>

                                    </div>
                                </form>
                                <!-- </form> -->
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