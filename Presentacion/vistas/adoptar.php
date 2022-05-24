<?php
require_once('BL/consultas_adopcion.php');
require_once('DAL/conexion.php');
require_once('DAL/clases/img_perritos.php');
require_once('DAL/clases/perritos.php');

$conexion = conexion::conectar();
$consulta = new Consulta_perro();

$imgPerro = $consulta->listarImagen_perro($conexion);
// $perro = $consulta->listarPerro($conexion);

?>


<div class="container adop-text text-center mt-4">
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
                <?php foreach ($imgPerro as $key => $value) : ?>
               <div class="item-gallery col-lg-4 col-md-6 mb-5">
                  <div class="polaroid-gallery">
                     <a href="index.php?modulo=adoptar-single=<?= $value['perro_id']; ?>">
                        <img src="data:image/<?php echo($value['img_perro_tipo']);?>;base64,<?php echo base64_encode( $value['img_perro_foto'] ); ?>" alt="" class="img-fluid">
                        <p class="caption-gallery" data-aos="zoom-in"><?=$value['perro_nombre'];?></p>
                     </a>
                  </div>
               </div>
            <?php endforeach; ?>
            </div>   
        </div>
    </div>
</div>
