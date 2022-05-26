<?php
    require_once('DAL/conexion.php');
    require_once('BL/consultas_adopcion.php');
    require_once('DAL/clases/img_perritos.php');
    require_once('DAL/clases/perritos.php');
    $conexion = conexion::conectar();
    $consulta = new Consulta_perro();

    $id = $_GET['id'];
    $perro = $consulta->listarPerro($conexion, $id);
    

    $imgPerro = $consulta->buscarImagen_perro($conexion, $id);

?>

<div id="preloader">
         <div class="spinner">
            <div class="bounce1"></div>
         </div>
      </div>
      <!-- Section Adoption -->
    <section id="adoption" class="pages">

        <div class="jumbotron ">
            <!-- Heading -->
            
            <div class="jumbo-heading">
            <h1><?php echo ($perro['perro_nombre']) ?></h1>
            </div>

        </div>
         <!-- container-->
		<div class="container">
               <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?modulo=adoptar" class="breadcrumb-link">Galeria de Adopción</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $perro ['perro_nombre']; ?></li>
                </ol>
            </nav>
        </div>
        <div class="container margin1">
            <div class="row">
                <div class="col-md-5">
                    <img src="data:image/<?php echo($imgPerro['img_perro_tipo']);?>;base64,<?php echo base64_encode( $imgPerro['img_perro_foto'] ); ?>" class="img-fluid" alt="foto perrito en adopcion">
                </div>
                <div class="col-md-7 res-margin">
                    <div class="pet-adopt-info">
                        <h6 class="mx-3">Sexo:<h6 class="text-dark me-2"><?= $perro ['perro_sexo']; ?></h6></h6><img src="Presentacion/libs/images/paw.png" alt="foto perrito en adopcion" width="20" height="20">
                        <h6 class="mx-3">Tamaño: <h6 class="text-dark me-2"><?= $perro ['perro_tamano']; ?></h6></h6><img src="Presentacion/libs/images/paw.png" alt="foto perrito en adopcion" width="20" height="20">
                        <h6 class="mx-3">Actividad:<h6 class="text-dark me-2"> <?= $perro ['perro_actividad']; ?></h6></h6><img src="Presentacion/libs/images/paw.png" alt="foto perrito en adopcion" width="20" height="20">
                        <h3 class="mt-3">Descripción</h3>
                        <p><?= $perro ['perro_descripcion']; ?>
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
