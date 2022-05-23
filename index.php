<?php
session_start();
error_reporting(0);
$mysesion = $_SESSION['usuario'];

$modulo = $_REQUEST['modulo'] ?? '';
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

    <title>Albergue de perritos<?php echo ($modulo == "adoptar") ? " - Adopción " : " ";
                                echo ($modulo == "apadrinar") ? " - Apadrinar " : " ";
                                echo ($modulo == "tienda") ? " - Tienda " : " ";
                                echo ($modulo == "donar") ? " - Donación " : " ";
                                echo ($modulo == "blog") ? " - Blog " : " ";
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
                        <a class="nav-link <?php echo ($modulo == "tienda") ? " active " : " " ?> mx-2" href="index.php?modulo=tienda">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($modulo == "donar") ? " active " : " " ?> mx-2" href="index.php?modulo=donar">Donar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($modulo == "blog") ? " active " : " " ?> mx-2" href="index.php?modulo=blog">Blog</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link <?php echo ($modulo == "prueba") ? " active " : " " ?> mx-2" href="index.php?modulo=prueba">Prueba</a>
                    </li>
                </ul>
                <?php if ($mysesion == null || $mysesion == '') {
                ?>
                    <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#ModalLogin">Iniciar Sesion</button>
                <?php
                } else {
                ?>
                    <div class="dropdown mx-4">
                        <a class="dropdown-toggle text-uppercase" type="button" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['usuario'] ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuUser">
                            <li>
                                <a href="BL/cerrar_sesion.php">Cerrar Sesión</a>
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
                                <input type="text" class="form-control" id="user" name="user" placeholder="usuario">
                                <label for="floatingInput">Usuario</label>
                            </div>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="pass" name="pass" placeholder="contraseña">
                                <label for="pass">Contraseña</label>
                            </div>

                            <!-- <div class="checkbox mb-3">
                                <label>
                                    <input type="checkbox" value="remember-me"> Remember me
                                </label>
                            </div> -->
                            <button class="w-100 btn btn-lg btn-primary mt-3" type="submit">Iniciar Sesión</button>
                            <p class="mt-5 mb-3 text-muted">© 2021–<span id="anio"></p>
                        </form>
                    </main>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <a href="index.php?modulo=registro" class="btn btn-primary">Registrarse</a>
                </div>
            </div>
        </div>
    </div>

    <!-- BODY -->
    <div class="container mb-5">
        <?php
        if (isset($_REQUEST['mensaje'])) {
        ?>
            <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
                <strong>Exito!</strong> <?php echo $_REQUEST['mensaje']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
        } else if (isset($_REQUEST['error'])) {
        ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong> <?php echo $_REQUEST['error']; ?>
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
        if ($modulo == "prueba") {
            include_once "Presentacion/vistas/prueba.php";
        }
        if ($modulo == "registro") {
            include_once "Presentacion/vistas/registro_user.php";
        }


        ?>

    </div>


    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row bg-light">
                <p class="text-center mt-3">© <span id="anio_footer"></span> PlanetDog.com by FJF WEB SAC</p>
            </div>
        </div>
    </footer>

</body>
<!-- LINKS SCRIPT -->
<script src="Presentacion/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/f52de5d372.js" crossorigin="anonymous"></script>
<script src="Presentacion/libs/javascript/jquery-3.6.0.min.js"></script>
<script src="Presentacion/libs/javascript/script.js"></script>



</html>