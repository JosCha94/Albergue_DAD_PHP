<?php
require_once 'SL/logueado.php';
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
$log = new autorizacion();
$logueado = $log->logueado($mysesion);
$rol = $log->activeRol($_SESSION['usuario'][2]);
$permiso = $log->activePermi($_SESSION['usuario'][5]);

switch ($error='SinError') {
   case ($logueado == 'false'):
      $error='Debe iniciar sesión para poder visualizar este pagina';
       break;
   case ($rol != 'true'):
      $error='No tiene activado el rol de Cliente';
       break;
   case ($permiso != 'true'):
      $error='Su rol actual no tiene permiso para acceder a esta pagina';
       break;
   break;
}  
?>
<?php
if ($error == 'SinError') {?>
<?php
      require_once('BL/consultas_tienda.php');
      $consulta = new Consulta_producto();
      $products = $consulta->listarProductos($conexion);
      $categories = $consulta->listarCategorias($conexion);

      ?>
      <div class="container adop-body mt-5">
         <div class="row">
            <div class="col-md-3 sidebar-filter">
               <h3 class="mt-0 mb-5">Tienda <br> Productos</h3>
               <h6 class="text-uppercase font-weight-bold mb-3">Categorias</h6>
               <?php foreach ($categories as $key => $value) : ?>
                  <div class="mt-2 mb-2 pl-2">
                     <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="category-1">
                        <label class="custom-control-label" for="category-1"><?= $value['cat_nombre']; ?></label>
                     </div>
                  </div>
               <?php endforeach; ?>

               <div class="divider mt-5 mb-5 border-bottom border-secondary"></div>
               <a href="#" class="btn btn-lg btn-block btn-primary mt-5">Carrito</a>
            </div>

            <div class="col-md-9">
               <div class="row">
                  <div class="col-8">
                     <div class="dropdown text-md-left text-center float-md-left mb-3 mt-3 mt-md-0 mb-md-0">
                        <label class="mr-2">Sort by:</label>
                        <a class="btn btn-lg btn-light dropdown-toggle" data-bs-toggle="dropdown" href="#" id="navbarDropdown" role="button" aria-expanded="false">Relevance</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(71px, 48px, 0px); top: 0px; left: 0px; will-change: transform;">
                           <li><a class="dropdown-item" href="#">Relevance</a></li>
                           <li><a class="dropdown-item" href="#">Price Descending</a></li>
                           <li><a class="dropdown-item" href="#">Price Ascending</a></li>
                           <li><a class="dropdown-item" href="#">Best Selling</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-4">
                     <div class="dropdown float-right">
                        <label class="mr-2">View:</label>
                        <a class="btn btn-lg btn-light dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">9 <span class="caret"></span></a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" x-placement="bottom-end" style="will-change: transform; position: absolute; transform: translate3d(120px, 48px, 0px); top: 0px; left: 0px;">
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

               <!-- productos -->
               <div class="wrapper-gallery row magnific-popup mt-5">
                  <!-- producto -->
                  <?php foreach ($products as $key => $value) : ?>
                     <div class="item-gallery col-lg-4 col-md-6">
                        <div class="polaroid-gallery">
                           <a href="index.php?modulo=prueba&id=<?= $value['product_id']; ?>" data-bs-toggle="modal" data-bs-target="#ModalProduct">
                              <img src="Presentacion\libs\images\img_perrito.jpg" alt="" class="img-fluid">
                              <p class="caption-gallery" data-aos="zoom-in"><?= $value['product_nombre']; ?></p>
                              <div class="row">
                                 <div class="col-6"><a href="">Mas detalles</a></div>
                                 <div class="col-6"><a href="">Añadir al carrito</a></div>
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
<?php 
} else {
?>
<div class="alert alert-danger" role="alert">
         <?php echo $error; ?>
      </div>
<?php
}
?>
