<?php
    require_once('BL/consultas_adopcion.php');
    require_once('DAL/clases/img_perritos.php');
    require_once('DAL/clases/perritos.php');
    require_once('DAL/conexion.php');


    $conexion = conexion::conectar();
    $consulta = new Consulta_perro();

    $p_id = $_REQUEST['id'];
    
    $perro_detalle = $consulta->listarPerro($conexion,$p_id);

    // $imgPerro = $consulta->listarImagen_perro($conexion);


?>
<div id="preloader">
         <div class="spinner">
            <div class="bounce1"></div>
         </div>
      </div>
      <!-- Preloader ends -->
      <!-- /navbar ends -->
      <!-- Section Adoption -->
    <section id="adoption" class="pages">

        <div class="jumbotron ">
            <!-- Heading -->
            
            <div class="jumbo-heading">
            <h1><?=$perro_detalle['perro_nombre']; ?></h1>
            </div>

        </div>
         <!-- container-->
		<div class="container">
               <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?modulo=adoptar" class="breadcrumb-link">Galeria de Adopción</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?=$perro_detalle ['perro_nombre']; ?></li>
                </ol>
            </nav>
        </div>
        <div class="container margin1">
            <div class="row">
                <div class="col-md-5">
                    <img src="Presentacion/libs/images/perro1.jpg" class="img-fluid" alt="Perro adopcion">
                </div>
                <div class="col-md-7 res-margin">
                    <div class="pet-adopt-info">
                        <h6 class="mx-3">Sexo: Macho</h6><img src="Presentacion/libs/images/paw.png" alt="Girl in a jacket" width="20" height="20">
                        <h6 class="mx-3">Tamaño: Grande</h6><img src="Presentacion/libs/images/paw.png" alt="Girl in a jacket" width="20" height="20">
                        <h6 class="mx-3">Actividad: mucha</h6><img src="Presentacion/libs/images/paw.png" alt="Girl in a jacket" width="20" height="20">
                        <h3 class="mt-3">Descripción</h3>
                        <p>Elit uasi quidem minus id omnis a nibh fusce mollis imperdie tlorem ipuset phas ellus ac sodales Lorem ipsum dolor Phas ellus 
                            ac sodales felis tiam non metus. lorem ipsum dolor sit amet, consectetur adipisicing elit uasi quidem minus id omnis a nibh fusce mollis imperdie tlorem ipuset campas fincas
                        </p>				 
                        <!-- ul custom-->
                        <ul class="custom no-margin">
                            <li>Aliquam erat volut pat.</li>
                            <li>Ibu lum orci eget, viverra elit liquam erat volut pat phas ellus ac.</li>
                            <li>Aliquam erat volut pat phas ellu</li>
                        </ul>
                        <a href="#" class="btn btn-adopt mt-5">¡Adopta ahora!</a>
                    </div>
                </div>
               <!-- /col-md-7-->
            </div>
         <!-- /row -->
		</div>
       <!-- /container -->

    </section>
      <!-- /Section ends -->
      <!-- Footer -->	
