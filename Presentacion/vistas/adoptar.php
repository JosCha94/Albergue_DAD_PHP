<?php
require_once('BL/consultas_adopcion.php');
require_once('DAL/conexion.php');

$conexion = conexion::conectar();
$consulta = new Consulta_adopcion();
$imgPerro = $consulta->listarImagen_perro($conexion);


?>


<div class="container adop-text text-center mt-4">
    <p class="h1">¡Ayúdanos a ayudar!</p>
    <p class="h5">Todos nuestros perritos están listos para ser adoptados y para que los cuides en su nueva vida</p>
</div>
<div class="container adop-body mt-5">
    <div class="row">
        <div class="col-md-2 sidebar-filter">
            <h3 class="mt-0 mb-5">Filtrar por:</h3>
            <div class="form-check">
                <input type="radio" class="form-check-input filtro" id="All" tamano="All" sexo="All" actividad="All" name="filtro" checked>
                <label class="form-check-label" for="All">Mostrar todo</label>
            </div>
            <div class="divider my-1 border-bottom border-secondary"></div>

            <h6 class="text-uppercase font-weight-bold mb-3">TAMAÑO</h6>
            <div class=" form-check mt-2 mb-2">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroT" id="category-1" tamano="Grande" name="filtro">
                    <label class="form-check-label" for="category-1">Grandes</label>
                </div>
            </div>
            <div class="form-check ">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroT" id="category-2" tamano="Mediano" name="filtro">
                    <label class="form-check-label" for="category-2">Medianos</label>
                </div>
            </div>
            <div class="form-check ">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroT" id="category-3" tamano="Pequeño" name="filtro">
                    <label class="form-check-label" for="category-3">Pequeños</label>
                </div>
            </div>
            <div class="divider my-1 border-bottom border-secondary"></div>
            <h6 class="text-uppercase font-weight-bold mb-3">EDAD</h6>
            <div class="form-check ">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroE" id="category-4" edad1="0" edad2="1" edad3="2" name="filtro">
                    <label class="form-check-label" for="category-4">De 0 a 2 años</label>
                </div>
            </div>
            <div class=" form-check ">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroE" id="category-5" name="filtro" edad1="3" edad2="4" edad3="5">
                    <label class="form-check-label" for="category-5">De 3 a 5 años</label>
                </div>
            </div>
            <div class="form-check ">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroE" id="category-6" name="filtro" edad1="6" edad2="7" edad3="8">
                    <label class="form-check-label" for="category-6">De 6 a 8 años</label>
                </div>
            </div>
            <div class="form-check ">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroE" id="category-7" name="filtro" edad1="9" edad2="10" edad3="11">
                    <label class="form-check-label" for="category-7">De 9 a más años</label>
                </div>
            </div>
            <div class="divider my-1 border-bottom border-secondary"></div>
            <h6 class="text-uppercase  font-weight-bold">SEXO</h6>
            <div class="form-check mt-2 mb-2">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroS" id="filter-size-1" sexo="M" name="filtro">
                    <label class="form-check-label" for="filter-size-1">Macho</label>
                </div>
            </div>
            <div class="form-check ">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroS" id="filter-size-2" sexo="H" name="filtro">
                    <label class="form-check-label" for="filter-size-2">Hembra</label>
                </div>
            </div>
            <div class="divider my-1 border-bottom border-secondary"></div>
            <h6 class="text-uppercase  font-weight-bold">NIVEL DE ACTIVIDAD</h6>
            <div class="form-check mt-2 mb-2">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroA" id="category-8" actividad="Ligera" name="filtro">
                    <label class="form-check-label" for="category-8">Ligera</label>
                </div>
            </div>
            <div class="form-check">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroA" id="category-9" actividad="Moderada" name="filtro">
                    <label class="form-check-label" for="category-9">Moderada</label>
                </div>
            </div>
            <div class="form-check ">
                <div class="custom-control custom-checkbox">
                    <input type="radio" class="form-check-input filtroA" id="category-10" actividad="Intensa" name="filtro">
                    <label class="form-check-label" for="category-10">Intensa</label>
                </div>
              
            </div>
         </div>

        <div class="col-md-10">
            <!-- perritos -->
            <div class="wrapper-gallery row magnific-popup mt-5">
                <?php foreach ($imgPerro as $key => $value) : ?>
                <div class="item-gallery col-lg-4 col-md-6 mb-5 perrito" tamano="<?= $value['perro_tamano']; ?>" sexo="<?= $value['perro_sexo']; ?>" actividad ="<?= $value['perro_actividad']; ?>" edad1="<?= $value['edad_perrito']; ?>" edad2="<?= $value['edad_perrito']; ?>" edad3="<?= $value['edad_perrito']; ?>"  >
                    <div class="polaroid-gallery">
                    <form action="index.php?modulo=adoptar-single" method="post">
                        <input type="hidden" value="<?php echo $value['perro_id'];?>" name="idPerro">
                        <button class="border-0 btn btn-link text-decoration-none" name="verPerro">
                            <img src="data:image/<?php echo($value['img_perro_tipo']);?>;base64,<?php echo base64_encode( $value['img_perro_foto']); ?>" alt="" class="img-fluid">
                            <p class="caption-gallery" data-aos="zoom-in"><?=$value['perro_nombre'];?></p>
                        </button>
                    </form> 
                  </div>
                  
               </div>
            <?php endforeach; ?>
            </div>   
        </div>
    </div>
</div>
