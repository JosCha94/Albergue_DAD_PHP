<?php
require_once('BL/consultas_tienda.php');
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
$consulta = new Consulta_producto();

$products = $consulta->listarProductos($conexion);
$categories = $consulta->listarCategorias($conexion);

?>
<div class="container adop-body mt-5">
   <div class="row">
      <div class="col-md-3 sidebar-filter">
         <h3 class="mt-0 mb-5">Tienda <br> Productos</h3>
         <h6 class="text-uppercase font-weight-bold mb-3">Categorias</h6>
            <div class="form-check">
               <input class="form-check-input categoria" category="All" type="radio" name="flexRadioProduct" id="flexRadioTodos" checked>
               <label class="form-check-label" for="flexRadioTodos">
                  Todas
               </label>
            </div>
         <?php foreach ($categories as $key => $value) : ?>            
            <div class="form-check">
               <input class="form-check-input categoria" category="<?= $value['cat_id']; ?>" type="radio" name="flexRadioProduct" id="RadioProduct<?= $value['cat_nombre']; ?>">
               <label class="form-check-label" for="RadioProduct<?= $value['cat_nombre']; ?>">
                  <?= $value['cat_nombre']; ?>
               </label>
            </div>
            <!-- <div class="mt-2 mb-2 pl-2">
               <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input categoria" category="<?= $value['cat_id']; ?>">
                  <label class="custom-control-label" for="category-1"><?= $value['cat_nombre']; ?></label>
               </div>
            </div> -->
         <?php endforeach; ?>

         <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
         <a href="#" class="btn btn-lg btn-block btn-primary mt-5">Carrito</a>
      </div>

      <div class="col-md-9">
         <div class="row">
            <div class="col-8">
               <div class="dropdown text-md-left text-center float-md-left mb-3 mt-3 mt-md-0 mb-md-0">
                  <label class="mr-2 fs-4">Perrito:</label>
                  <a class="btn btn-lg btn-light dropdown-toggle" data-bs-toggle="dropdown" href="#" id="navbarDropdown" role="button" aria-expanded="false">Tamaño</a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(71px, 48px, 0px); top: 0px; left: 0px; will-change: transform;">
                     <li><a class="dropdown-item sizes" size="Pequeno" href="#">Pequeño</a></li>
                     <li><a class="dropdown-item sizes" size="Mediano" href="#">Mediano</a></li>
                     <li><a class="dropdown-item sizes" size="Grande" href="#">Grande</a></li>
                  </ul>
               </div>
            </div>
         </div>

         <!-- productos -->
         <div class="wrapper-gallery row magnific-popup mt-5">
            <!-- producto -->
            <?php foreach ($products as $key => $value) : ?>
               <div class="item-gallery col-lg-4 col-md-6 producto" category="<?= $value['cat_id']; ?>" dog_size="<?= $value['product_size_perro']; ?>">
                  <div class="polaroid-gallery">
                     <a href="index.php?modulo=product_detail&id=<?=$value['product_id'];?>">
                     <img src="data:image/<?php echo($value['img_product_tipo']);?>;base64,<?php echo base64_encode( $value['img_product_foto'] ); ?>" alt="<?= $value['product_nombre']; ?>" class="img-fluid">
                        <p class="caption-gallery" data-aos="zoom-in"><?= $value['product_nombre']; ?></p>
                        <div class="row">
                        <button type="button" class="btn btn-outline-danger">Añadir al carrito</button>
                        </div>

                     </a>
                  </div>
               </div>
            <?php endforeach; ?>
         </div>
         <!-- END CARD -->
         <div class="row sorting mb-5 mt-5">
            <div class="col-8">
               <a class="btn btn-light"><i class="fas fa-arrow-up mr-2 scroll_up"></i> Back to top</a>
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