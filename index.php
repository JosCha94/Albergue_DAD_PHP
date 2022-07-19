<?php
session_start();
error_reporting(0);
session_regenerate_id(true);
require_once 'SL/permisos.php';
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
$log = new autorizacion();
$logueado = $log->logueado($_SESSION['usuario']);
$rolActual = $log->RolActual($_SESSION['usuario'][2]);

$info = json_decode($_SESSION['usuario'][1]);


if($_SESSION['permisos'] == null || $_SESSION['permisos'] == ''):
    $_SESSION['permisos'] = $log->roles_permitidos_btn($conexion);
endif;


$PermisosVistas = $_SESSION['permisos'];

$compras = $log->permisosVistas($PermisosVistas['area_compras']);
$PermisosVistaPag = $log->permisosVistas($PermisosVistas['bloqueo_vistas']);


$modulo = $_GET['modulo'] ?? '';

switch ($error = 'SinError') {
    case ($conexion  == 'fallo'):
        $error = 'Error de conexión';
        break;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="adopcion, perritos, donaciones, albergues, suscripción">
    <meta name="description" content="Adopta un perrito en el albergue, dona para apoyar al albergue, suscribete a un plan para apadrinar, coprar productos para el perrito">
    <!-- LINKS HOJAS DE ESTILOS -->
    <link rel="stylesheet" href="Presentacion\libs\datatable\dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="Presentacion/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Presentacion/libs/css/estilos.css">
    <link rel="stylesheet" href="Presentacion/libs/flaticon/flaticon.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@500&display=swap" rel="stylesheet">

    <title>Albergue de perritos<?php
                                switch ($modulo) {
                                    case ("adoptar"):
                                        echo " - Adopción ";
                                        break;
                                    case ("adoptar-single"):
                                        echo " - Adopción ";
                                        break;
                                    case ("apadrinar"):
                                        echo " - Apadrinar ";
                                        break;
                                    case ("tienda"):
                                        echo " - Tienda ";
                                        break;
                                    case ("product_detail"):
                                        echo " - Tienda ";
                                        break;
                                    case ("carrito"):
                                        echo " - Tienda ";
                                        break;
                                    case ("donar"):
                                        echo " - Donación ";
                                        break;
                                    case ("blog"):
                                        echo " - Blog ";
                                        break;
                                    case ("registro"):
                                        echo " - Registro de usuario ";
                                        break;
                                    case ("perfil-usuario"):
                                        echo " - Perfil de usuario ";
                                        break;
                                }
                                ?>

    </title>
</head>
<?php if ($error == 'SinError') : ?>

    <body>
        <!-- HEADER -->
        <div class="container-fluid" id="nav_principal">
            <nav class="navbar navbar-expand-lg navbar-dark bg-transparent container-fluid">

                <a class="navbar-brand" href="index.php?modulo=inicio">
                    <a href="index.php?modulo= " id="logo_header"><img src="Presentacion/libs/images/doglogo.png" alt="logo" width="80em"></a>

                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link <?php echo ($modulo == "adoptar" || $modulo == "adoptar-single") ? " active " : " " ?> mx-2" href="index.php?modulo=adoptar">Adoptar</a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link <?php echo ($modulo == "apadrinar") ? " active " : " " ?> mx-2" href="index.php?modulo=apadrinar">Apadrinar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($modulo == "tienda" || $modulo == "product_detail" || $modulo == "carrito") ? " active " : " " ?> mx-2" href="index.php?modulo=tienda">Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($modulo == "donar") ? " active " : " " ?> mx-2" href="index.php?modulo=donar">Donar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($modulo == "blog" || $modulo == "blog-single") ? " active " : " " ?> mx-2" href="index.php?modulo=blog">Blog</a>
                        </li>
                        <?php $rolVendedor = $log->RolPermitido($_SESSION['usuario'][2], $compras); 
                        if($rolVendedor == 'true'):?>
                        <li class="nav-item">
                            <a class="nav-link <?php echo ($modulo == "compras" ) ? " active " : " " ?> mx-2" href="index.php?modulo=compras">Retiro de Compras</a>
                        </li>
                        <?php endif; ?>

                    </ul>
                    <?php if ($logueado == null || $logueado == 'false') {
                    ?>
                        <button type="button" class="btn btn-login m-3" data-bs-toggle="modal" data-bs-target="#ModalLogin">Iniciar Sesión</button>
                    <?php
                    } else {
                    ?>
                    <div class="d-flex justify-content-between">
                        <div class="dropdown mx-4">
                            <a class="dropdown-toggle text-uppercase text-light text-decoration-none" type="button" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $info->nick; ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-lg-end p-3 shadow-lg" aria-labelledby="dropdownMenuUser">
                                <li class="mb-2">
                                    <a href="index.php?modulo=perfil-usuario" class="text-decoration-none " title="Perfil usuario">Mi perfil</a>
                                </li>
                                <li>
                                    <a href="BL/cerrar_sesion.php?modulo=&sesion=cerrar" class="text-decoration-none" title="Cerrar Sessión">Cerrar Sesión</a>
                                </li>
                            </ul>
                        </div>
                        <a href="index.php?modulo=carrito" class="cart mx-3 text-light fs-5 me-3"><i class="fa-solid fa-cart-shopping"></i></a>
                    </div>
                    <?php
                    }
                    ?>

                </div>

            </nav>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="ModalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bienvenido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> -->
                    <div class="modal-body">
                        <main class="form-signin">
                            <form action="BL/valida_user.php" method="post">

                                <h1 class="h3 mb-3 fw-normal text-center">Bienvenido</h1>

                                <div class="form-floating">
                                    <input type="text" class="form-control mb-3" id="user" name="user" placeholder="Correo electrónico o número de celular">
                                    <label for="floatingInput">Correo electrónico o número de celular</label>
                                </div>
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
                                    <label for="pass">Contraseña</label>
                                </div>

                                <!-- <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div> -->
                                <button class="w-100 btn btn-login mt-3" type="submit">Iniciar Sesión</button>
                                <p class="mt-5 mb-3 text-muted">© 2021–<span class="anio"></p>
                            </form>
                        </main>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <a href="index.php?modulo=registro" class="btn btn-login">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>


    
          <!-- BODY -->     
        <div class="container-fluid cont-inicio">        
            <?php            
        if ($modulo == "" || $modulo == "inicio") {
                include_once "Presentacion/vistas/inicio.php";
            }
            ?>
        </div>        
        <div class="container mb-5">
            <?php
            if (isset($_GET['mensaje'])) {
            ?>
                <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
                    <strong>Exito!</strong> <?php echo $_GET['mensaje']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            } else if (isset($_GET['error'])) {
            ?>
                <div class="alert alert-danger alert-dismissible fade show " role="alert">
                    <strong>Error!</strong> <?php echo $_GET['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
            }          
            if ($modulo == "adoptar") {
                include_once "Presentacion/vistas/adoptar.php";
            }
            if ($modulo == "apadrinar") {
                include_once "Presentacion/vistas/apadrinar.php";
            }
            if ($modulo == "tienda") {
                include_once "Presentacion/vistas/tienda.php";
            }
            if ($modulo == "donar") {
                include_once "Presentacion/vistas/donar.php";
            }
            if ($modulo == "blog") {
                include_once "Presentacion/vistas/blog.php";
            }
            if ($modulo == "adoptar-single") {
                include_once "Presentacion/vistas/adoptar-single.php";
            }
            if ($modulo == "blog-single") {
                include_once "Presentacion/vistas/blog-single.php";
            }
            if ($modulo == "registro") {
                include_once "Presentacion/vistas/registro_user.php";
            }
            if ($modulo == "perfil-usuario") {
                include_once "Presentacion/vistas/perfil-usuario.php";
            }
            if ($modulo == "update-user") {
                include_once "Presentacion/vistas/update-usuario.php";
            }
            if ($modulo == "product_detail") {
                include_once "Presentacion/vistas/detalle_producto.php";
            }
            if ($modulo == "carrito") {
                include_once "Presentacion/vistas/carrito.php";
            }
            if ($modulo == "adoptar-formulario") {
                include_once "Presentacion/vistas/adoptar-formulario.php";
            }
            if ($modulo == "apadrinar-detalles") {
                include_once "Presentacion/vistas/apadrinar-detalles.php";
            }
            if ($modulo == "voucher") {
                include_once "Presentacion/vistas/voucher.php";
            }
            if ($modulo == "compras") {
                include_once "Presentacion/vistas/compras.php";
            }
            if ($modulo == "detalle_compra") {
                include_once "Presentacion/vistas/detalle_compra.php";
            }

            ?>
        </div>

        <!-- FOOTER -->
        <footer class="footer-area" id="footer-area">
            <!--== Start Footer Main ==-->
            <div class="footer-main mt-5">
                <div class="container pt-0 pb-0">
                    <div class="row">
                        <div class="col-md-6 col-lg-3">
                            <div class="widget-item widget-about">
                                <h4 class="widget-title">Planet Dog</h4>
                                <p class="desc">Albergue</p>
                                <div class="social-icons">
                                    <a href=""><i class="fab fa-facebook"></i></a>
                                    <a href=""><i class="fab fa-instagram"></i></a>
                                    <a href=""><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget-item nav-menu-item1">
                                <h4 class="widget-title">Información</h4>
                                <div class="widget-menu-wrap">
                                    <ul class="nav-menu">
                                        <li><a href="#">Acerca de nosotros</a></li>
                                        <li><a href="">Politicas de privacidad</a></li>
                                        <li><a href="">Terminos y condiciones</a></li>
                                        <li><a href="">Contactanos</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget-item nav-menu-item2">
                                <h4 class="widget-title">Mapa del sitio</h4>
                                <div class="widget-menu-wrap">
                                    <ul class="nav-menu">
                                        <li><a href="index.php?modulo=adoptar">Adoptar</a></li>
                                        <li><a href="index.php?modulo=apadrinar">Apadrinar</a></li>
                                        <li><a href="index.php?modulo=tienda">Tienda virtual</a></li>
                                        <li><a href="index.php?modulo=donar">Donaciones</a></li>
                                        <li><a href="index.php?modulo=blog">Blog</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="widget-item">
                                <h4 class="widget-title">Información de contacto</h4>
                                <div class="widget-contact-info">
                                    <p class="contact-info-desc">Si tienes alguna duda o pregunta, por favor escríbenos a: <a href="mailto://demo@example.com">albergue.adoptar.perritos@gmail.com</a></p>
                                    <div class="contact-item">
                                        <div class="icon">
                                            <i class="pe-7s-map-marker"></i>
                                        </div>
                                        <div class="info">
                                            <p>Direccion <br> Calle 200.</p>
                                        </div>
                                    </div>
                                    <div class="contact-item phone-info">
                                        <div class="icon">
                                            <i class="pe-7s-phone"></i>
                                        </div>
                                        <div class="info">
                                            <p><i class="fa-brands fa-whatsapp"></i> <span>Escríbenos al WhatsApp</span> <br><a href="">+51 999 888 333</a></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--== End Footer Main ==-->

            <!--== Start Footer Bottom ==-->
            <div class="footer-bottom">
                <div class="container pt-0 pb-0">
                    <div class="row">
                        <div class="col-12">
                            <div class="footer-bottom-content">
                                <div class="payment">
                                    <a href="account.html"><img src="Presentacion/libs/images/payment.webp" width="192" height="21" alt="Payment Logo"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <p class="text-center mt-3">© <span class="anio"></span> PlanetDog.com by FJF WEB SAC</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--== End Footer Bottom ==-->
        </footer>
    </body>
<?php endif; ?>
<!-- LINKS SCRIPT -->
<script src="Presentacion/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Presentacion\libs\fontawesome\js\all.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script> -->
<script src="Presentacion/libs/javascript/jquery-3.6.0.min.js"></script>
<script src="Presentacion/libs/javascript/script.js"></script>
<script src="Presentacion\libs\datatable\jquery.dataTables.min.js"></script>
<script src="Presentacion\libs\datatable\dataTables.bootstrap5.min.js"></script>

</html>