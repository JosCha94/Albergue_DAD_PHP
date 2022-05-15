<!DOCTYPE html>
<html lang="en">
<?php

$modulo = $_REQUEST['modulo'] ?? '';

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="adopcion, perritos, donaciones, albergues, suscripción">
    <meta name="description" content="Adopta un perrito en el albergue, dona para apoyar al albergue, suscribete a un plan para apadrinar, coprar productos para el perrito">
    <link rel="stylesheet" href="Presentacion/libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Presentacion/libs/css/estilos.css">
    <script src="Presentacion/libs/javascript/funciones.js">
    </script>
    <title>Albergue de perritos<?php echo ($modulo == "adoptar") ? " - Adopción " : " ";
                                echo ($modulo == "apadrinar") ? " - Apadrinar " : " ";
                                echo ($modulo == "tienda") ? " - Tienda " : " ";
                                echo ($modulo == "donar") ? " - Donación " : " ";
                                echo ($modulo == "blog") ? " - Blog " : " "; ?>
    </title>
</head>

<body>
    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light container-fluid">
        <div class="container">
            <a class="navbar-brand" href="index.php?modulo=inicio">
                <a href="index.php?modulo= "><img src="Presentacion/libs/images/doglogo.png" alt="logo" width="80em"></a>

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item ">
                        <a class="nav-link <?php echo ($modulo == "adoptar") ? " active " : " " ?> mx-2" href="index.php?modulo=adoptar">Adoptar</a>
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
                </ul>
                <button type="button" class="btn btn-light" onclick="saludame();">Iniciar Sesion</button>
            </div>
        </div>
    </nav>


    <!-- BODY -->
    <div class="container mb-5" >
        <?php

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


        ?>

    </div>


    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row bg-light">
                <p class="text-center mt-3">© <span id="anio"></span> PlanetDog.com by FJF WEB SAC</p>
            </div>
        </div>
    </footer>

</body>
<script src="feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>
<script src="https://kit.fontawesome.com/f52de5d372.js" crossorigin="anonymous"></script>
<script src="Presentacion/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="Presentacion/libs/javascript/jquery-3.6.0.min.js"></script>
<script src="Presentacion/libs/javascript/script.js"></script>


</html>