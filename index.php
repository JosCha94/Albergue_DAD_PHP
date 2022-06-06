<?php
session_start();
error_reporting(0);
session_regenerate_id(true);
require_once 'SL/permisos.php';
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
$log = new autorizacion();
$logueado = $log->logueado($_SESSION['usuario']);
$rol = $log->activeRol($_SESSION['usuario'][2]);

$modulo = $_GET['modulo'] ?? '';

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
    <link rel="stylesheet" href="Presentacion/libs/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="Presentacion/libs/css/estilos.css">
    <link rel="stylesheet" href="Presentacion/libs/flaticon/flaticon.css">

    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Thambi+2:wght@500&display=swap" rel="stylesheet">

    <title>Albergue de perritos<?php echo ($modulo == "adoptar" || "adoptar-single") ? " - Adopción " : " ";
                                echo ($modulo == "apadrinar") ? " - Apadrinar " : " ";
                                echo ($modulo == "tienda" || "product_detail" || "carrito") ? " - Tienda " : " ";
                                echo ($modulo == "donar") ? " - Donación " : " ";
                                echo ($modulo == "blog" || "blog-single") ? " - Blog " : " ";
                                echo ($modulo == "registro") ? " - Registro de usuario " : " "; ?>

    </title>
</head>

<body>
    <!-- HEADER -->
    <div class="container-fluid" id="nav_principal">
        <nav class="navbar navbar-expand-lg navbar-light .bg-transparent container-fluid">

            <a class="navbar-brand" href="index.php?modulo=inicio">
                <a href="index.php?modulo= "><img src="Presentacion/libs/images/doglogo.png" alt="logo" width="80em"></a>

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
                </ul>
                <?php if ($logueado == null || $logueado == 'false') {
                ?>
                    <button type="button" class="btn btn-login m-3" data-bs-toggle="modal" data-bs-target="#ModalLogin">Iniciar Sesion</button>
                <?php
                } else {
                ?>
                    <div class="dropdown mx-4">
                        <a class="dropdown-toggle text-uppercase" type="button" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['usuario'][1] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuUser">
                            <li>
                                <a href="BL/cerrar_sesion.php?modulo=&sesion=cerrar">Cerrar Sesión</a>
                            </li>
                        </ul>
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
                                <input type="text" class="form-control mb-3" id="user" name="user" placeholder="Correo electronico o numero de celular">
                                <label for="floatingInput">Correo electronico o numero de celular</label>
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
        if ($modulo == "" || $modulo == "inicio") {
            include_once "Presentacion/vistas/inicio.php";
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
        
        ?>
    </div>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container-fluid 
        <?php if ($logueado == 'false') {
            if ($modulo == "carrito" || $modulo == "adoptar-formulario" ) {
                echo "position-absolute bottom-0";
            } elseif ($modulo == "tienda") {
                echo "position-absolute bottom-10";
            }
        }
        ?>">
            <div class="row bg-light">
                <p class="text-center mt-3">© <span class="anio"></span> PlanetDog.com by FJF WEB SAC</p>
            </div>
        </div>
    </footer>

</body>
<!-- LINKS SCRIPT -->
<script src="Presentacion/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/all.min.js" crossorigin="anonymous"></script>
<script src="Presentacion/libs/javascript/jquery-3.6.0.min.js"></script>
<script src="Presentacion/libs/javascript/script.js"></script>



</html>