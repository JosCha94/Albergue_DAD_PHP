   <?php
   require_once('BL/consultas_tienda.php');
   require_once('DAL/conexion.php');
   $conexion = conexion::conectar();
   $consulta = new Consulta_producto();

   $products = $consulta->listarProductos($conexion);
   $resCatego = $categories = $consulta->listarCategorias($conexion);


   if (isset($_POST['carrito'])) {
      $idUser = $_SESSION['usuario'][0];
      $idProducto = $_POST['product_id'];
      $cantidad = $_POST['cantidad'];

      $res = $consulta->validarProductosCarrito($idProducto, $_SESSION['usuario'][5]);

      if ($res != 'true') {
         $resAdd = $consulta->agregarProductoAlCarrito($conexion, $idUser, $idProducto, $cantidad);
         if ($resAdd != 'errorAdd') {
            $Carrito = $_SESSION['usuario'][5];
            $array = json_decode($Carrito, true);
            $prodt = ['id' => (int)$idProducto];
            array_push($array, $prodt);
            $_SESSION['usuario'][5] = json_encode($array);
         }
      }
   }
   ?>
   <?php if ($logueado == 'false') { ?>
      <div class="alert alert-danger mt-5" role="alert">
         <h4 class="alert-heading">¡Atención!</h4>
         <p>Para poder comprar debes estar registrado y logueado</p>
         <hr>
         <p class="mb-0 h6">¡Gracias!</p>
      </div>
   <?php }  ?>
   <!-- <?php echo $_SESSION['usuario'][5]; ?> -->
   <div class="container adop-body mt-5">
      <div class="row">
         <div class="col-md-3 sidebar-filter">
            <h2 class="mt-0 mb-5">Tienda de<br> Productos</h2>
            <h4 class="text-uppercase font-weight-bold mb-3">FILTRAR POR:</h4>
            <div class="divider mb-1 mt-3 border-bottom border-secondary"></div>
            <?php if ($resCatego != 'falloCatego') : ?>
               <h6 class="text-uppercase font-weight-bold mb-3">Categorias:</h6>
               <?php foreach ($categories as $key => $value) : ?>
                  <div class="form-check">
                     <input class="form-check-input categoria" category="<?= $value['cat_id']; ?>" type="radio" name="flexRadioProduct" id="RadioProduct<?= $value['cat_nombre']; ?>">
                     <label class="form-check-label" for="RadioProduct<?= $value['cat_nombre']; ?>">
                        <?= $value['cat_nombre']; ?>
                     </label>
                  </div>
               <?php endforeach; ?>
               <div class="divider mb-1 mt-3 border-bottom border-secondary "></div>
               <!-- ------------------------------------ -->
               <h6 class="text-uppercase font-weight-bold mb-3">Segun el tamaño<br> del perrito:</h6>
               <div class="form-check">
                  <input class="form-check-input sizes" size="Pequeno" type="radio" name="flexRadioProduct" id="RadioProductPequeno">
                  <label class="form-check-label" for="RadioProductPequeno">
                     Pequeño
                  </label>
               </div>
               <div class="form-check">
                  <input class="form-check-input sizes" size="Mediano" type="radio" name="flexRadioProduct" id="RadioProductMediano">
                  <label class="form-check-label" for="RadioProductMediano">
                     Mediano
                  </label>
               </div>
               <div class="form-check">
                  <input class="form-check-input sizes" size="Grande" type="radio" name="flexRadioProduct" id="RadioProductGrande">
                  <label class="form-check-label" for="RadioProductGrande">
                     Grande
                  </label>
               </div>
               <!-- ------------------------------------ -->
               <div class="divider mb-1 mt-3 border-bottom border-secondary "></div>
               <div class="form-check">
                  <input class="form-check-input categoria" category="All" type="radio" name="flexRadioProduct" id="flexRadioTodos" checked>
                  <label class="form-check-label" for="flexRadioTodos">
                     Mostrar todo
                  </label>
               </div>
            <?php endif; ?>

            <!-- <div class="divider mt-5 mb-5 border-bottom border-secondary"></div> -->
            <?php if ($logueado == 'false') {
            } else { ?>
               <a href="index.php?modulo=carrito" class="btn btn-lg btn-block btn-primary mt-5">Carrito</a>
            <?php } ?>
         </div>

         <div class="col-md-9">
            <!-- <div class="row">
            <div class="col-8">
               <div class="dropdown text-md-left text-center float-md-left mb-3 mt-3 mt-md-0 mb-md-0">
                  <label class="mr-2 fs-4">Para Perritos:</label>
                  <a class="btn btn-lg btn-light dropdown-toggle" data-bs-toggle="dropdown" href="#" id="navbarDropdown" role="button" aria-expanded="false">Tamaño</a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdown" x-placement="bottom-start" style="position: absolute; transform: translate3d(71px, 48px, 0px); top: 0px; left: 0px; will-change: transform;">
                     <li><a class="dropdown-item sizes" size="Pequeno" href="#">Pequeño</a></li>
                     <li><a class="dropdown-item sizes" size="Mediano" href="#">Mediano</a></li>
                     <li><a class="dropdown-item sizes" size="Grande" href="#">Grande</a></li>
                  </ul>
               </div>
            </div>
         </div> -->

            <!-- productos -->
            <div class="wrapper-gallery row magnific-popup mt-5">
               <!-- producto -->
               <!--  -->
               <?php foreach ($products as $key => $value) : ?>

                  <div class="item-gallery col-lg-4 col-md-6 producto" category="<?= $value['cat_id']; ?>" dog_size="<?= $value['product_size_perro']; ?>">
                     <div class="polaroid-gallery">
                        <form action="index.php?modulo=product_detail" method="post">
                           <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                           <button class="border-0 btn btn-link text-decoration-none" name="cambiarDatosProducto" title="Detalles de <?= $value['product_nombre']; ?>">
                              <img src="data:image/<?php echo ($value['img_product_tipo']); ?>;base64,<?php echo base64_encode($value['img_product_foto']); ?>" alt="<?= $value['product_nombre']; ?>" class="img-fluid">
                           </button>
                        </form>
                        <p class="caption-gallery" data-aos="zoom-in"><?= $value['product_nombre']; ?></p>
                        <p class="h5 text-dark" data-aos="zoom-in">S/ <?= $value['product_precio']; ?></p>
                        <?php if ($logueado == 'false') {
                        } else { ?>
                           <form action="" method="post" id="form_producto" name="form_producto">
                              <div class="row">

                                 <input type="hidden" name="product_id" value="<?= $value['product_id']; ?>">
                                 <input type="hidden" name="cantidad" value="1">
                                 <?php if ($consulta->validarProductosCarrito($value['product_id'], $_SESSION['usuario'][5])) : ?>
                                    <button class="btn btn-outline-danger" name="" disabled>Producto añadido al carrito</button>
                                 <?php else : ?>
                                    <button class="btn btn-outline-danger" name="carrito">Añadir al carrito</button>
                                 <?php endif; ?>
                              </div>
                           </form>
                        <?php } ?>

                     </div>

                  </div>

               <?php endforeach; ?>

            </div>
            <!-- END CARD -->
            <div class="row sorting mb-5 mt-5">
               <div class="col-8">
                  <a class="btn btn-light scroll_up"><i class="fas fa-arrow-up mr-2 scroll_up"></i> Regresar</a>
               </div>
               <!-- <div class="col-4">
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
            </div> -->
            </div>
         </div>
      </div>
   </div>