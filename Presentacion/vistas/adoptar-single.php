<?php
require_once('DAL/conexion.php');
require_once('BL/consultas_adopcion.php');
$conexion = conexion::conectar();
$consulta = new Consulta_adopcion();
$id = $_GET['id'];
$imgActive = $consulta->mostarImagenes_perro($conexion, $id);
$perro = $consulta->listarPerro($conexion, $id);
$imgPerro = $consulta->buscarImagen_perro($conexion, $id);
?>
<div id="preloader">
    <div class="spinner">
        <div class="bounce1"></div>
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
                    <li class="breadcrumb-item active" aria-current="page"><?= $perro['perro_nombre']; ?></li>
                </ol>
            </nav>
        </div>
        <div class="container margin1">
            <div class="row">
                <div class="col-md-5">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="data:image/<?php echo ($imgActive['img_perro_tipo']); ?>;base64,<?php echo base64_encode($imgActive['img_perro_foto']); ?>" class="d-block w-100" alt="perro en adopcion">
                            </div>
                            <?php foreach ($imgPerro as $key => $value) : ?>
                                <div class="carousel-item">
                                    <img src="data:image/<?php echo ($value['img_perro_tipo']); ?>;base64,<?php echo base64_encode($value['img_perro_foto']); ?>" class="img-fluid" alt="perro foto">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-7 ps-5">
                    <div class="pet-adopt-info">
                        <h6 class="mx-3">Sexo:<h6 class="text-dark me-2"><?= $perro['perro_sexo']; ?></h6>
                        </h6><img src="Presentacion/libs/images/paw.png" alt="foto perrito en adopcion" width="20" height="20">
                        <h6 class="mx-3">Tamaño: <h6 class="text-dark me-2"><?= $perro['perro_tamano']; ?></h6>
                        </h6><img src="Presentacion/libs/images/paw.png" alt="foto perrito en adopcion" width="20" height="20">
                        <h6 class="mx-3">Actividad:<h6 class="text-dark me-2"> <?= $perro['perro_actividad']; ?></h6>
                        </h6><img src="Presentacion/libs/images/paw.png" alt="foto perrito en adopcion" width="20" height="20">
                        <h3 class="mt-5">Descripción</h3>
                        <p><?= $perro['perro_descripcion']; ?>
                        </p>
                        <!-- ul custom-->
                        <div class="container-tab mt-5">
                            <ul class="nav nav-tabs" id="dog-info-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Proceso</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Responsabilidad</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Seguimiento</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <ul class="ul-proceso ms-2 mt-4">
                                        <li>Al dar click en el botón de adoptar, serás direccionado a un formulario y el proceso de adopción comienza.</li>
                                        <li>Si no tienes cuenta, registrate e inicia sesión para llenar el formulario.</li>
                                        <li>Llena el formulario completo con los datos de la persona que será el responsable del perrito. Deben ser datos reales, pues serán verificados</li>
                                        <li>Al enviar el formulario, recibirás un correo electrónico en el que se te avisará que entras en un estado de espera por no más de 48 horas</li>
                                        <li>Durante el proceso de espera, los encargados del albergue revisarán tu caso y luego de pasar este filtro se te asignará via correo electrónico un dia para una entrevista por videollamada </li>
                                        <li>Luego de la videollamada, se te informará si eres apto para adoptar al perrito que elegiste </li>
                                    </ul>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <p class="p-responsabilidad  ms-2 mt-4">Adoptar un perrito del albergue es asumir el compromiso de mantenerlo, alimentarlo, cuidarlo, respetarlo, darle cariño y velar por su salud. Asegúrate de estar preparado para esta responsabilidad antes de solicitar la adopción. </p>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <p class="p-seguimiento  ms-2 mt-4">Nos pondremos en contacto con todos nuestros adoptantes al cumplirse la primera semana, mes, seis meses y año de haberse producido la adopción de su perrito. Se realizará vía medios digitales, pero el albergue se reserva el derecho de poder solicitar una cita presencial cuando lo considere pertinente</p>
                                </div>

                            </div>
                            <div class="d-grid justify-content-center btns">
                                <a href="index.php?modulo=adoptar-formulario&id=<?= $value['perro_id']; ?>" class="btn btn-adopt mt-3">¡Adóptalo ahora!</a><br>
                                <a href="index.php?modulo=apadrinar"><span>Si no puedes adoptarlo, ¡apadrínalo!</span> </a>
                            </div>
                        </div>
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
</div>