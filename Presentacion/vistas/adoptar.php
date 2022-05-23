<?php
require_once('BL/consultas_adopcion.php');
require_once('DAL/conexion.php');
require_once('DAL/clases/perritos.php');
require_once('DAL/clases/img_perritos.php');

$conexion = conexion::conectar();
$consulta = new Consulta_perro();

$perro = $consulta->listarPerro($conexion);
$imgPerro = $consulta->listarImagen_perro($conexion);

?>


<div class="container adop-text text-center">
    <h1>¡Ayudanos a ayudar!</h1>
    <p>Todos nuestros perritos estan listos para ser adoptados y para que los cuides en su neuva vida</p>
</div>
<div class="container adop-body mt-5">
    <div class="row">
        <div class="col-md-3 sidebar-filter">
            <h3 class="mt-0 mb-5">Filtrar por:</h3>
            <h6 class="text-uppercase font-weight-bold mb-3">TAMAÑO</h6>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-1">
                    <label class="custom-control-label" for="category-1">Grandes</label>
                </div>
            </div>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-2">
                    <label class="custom-control-label" for="category-2">Medianos</label>
                </div>
            </div>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-3">
                    <label class="custom-control-label" for="category-3">Pequeños</label>
                </div>
            </div>
            <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
            <h6 class="text-uppercase font-weight-bold mb-3">EDAD</h6>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-1">
                    <label class="custom-control-label" for="category-1">De 0 a 3 años</label>
                </div>
            </div>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-2">
                    <label class="custom-control-label" for="category-2">De 4 a 6 años</label>
                </div>
            </div>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-3">
                    <label class="custom-control-label" for="category-3">De 6 a 9 años</label>
                </div>
            </div>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-3">
                    <label class="custom-control-label" for="category-3">De 10 a más años</label>
                </div>
            </div>
            <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
            <h6 class="text-uppercase mt-5 mb-3 font-weight-bold">SEXO</h6>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="filter-size-1">
                    <label class="custom-control-label" for="filter-size-1">Macho</label>
                </div>
            </div>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="filter-size-2">
                    <label class="custom-control-label" for="filter-size-2">Hembra</label>
                </div>
            </div>
            <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
            <h6 class="text-uppercase mt-5 mb-3 font-weight-bold">NIVEL DE ACTIVIDAD</h6>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-1">
                    <label class="custom-control-label" for="category-1">Ligera</label>
                </div>
            </div>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-2">
                    <label class="custom-control-label" for="category-2">Moderada</label>
                </div>
            </div>
            <div class="mt-2 mb-2 pl-2">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="category-3">
                    <label class="custom-control-label" for="category-3">Intensa</label>
                </div>
            </div>
            <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
            <a href="#" class="btn btn-lg btn-block btn-primary mt-5">Filtrar</a>
        </div>

        <div class="col-md-9">
            <!-- perritos -->
            <div class="wrapper-gallery row magnific-popup mt-5">
            <?php foreach ($perro as $key => $value) : ?>
                
               <!-- Image 1 -->
               <div class="item-gallery col-lg-4 col-md-6 mb-5">
                   
                  <div class="polaroid-gallery">
                     <a href="index.php?modulo=adoptar-single">
                     <?php foreach ($imgPerro as $keyImg => $valueImg) : ?>
                        <img width="" src="data:image/jpeg;base64,<?php echo base64_encode( $valueImg ); ?>" alt="" class="img-fluid">
                     <?php endforeach; ?>
                        <p class="caption-gallery" data-aos="zoom-in"><?=$value['perro_nombre'];?></p>
                     </a>
                  </div>
               </div>
            <?php endforeach; ?>
            </div>   
            <div class="row sorting mb-5 mt-5">
                <div class="col-8">
                    <a class="btn btn-light"><i class="fas fa-arrow-up mr-2"></i> Back to top</a>
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
