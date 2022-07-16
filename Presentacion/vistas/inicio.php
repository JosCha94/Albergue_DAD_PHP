   <div id="carouselExampleCaptions" class="carousel slide mx-0 mb-5" data-bs-ride="carousel">
      <div class="carousel-indicators">
         <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
         <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
         <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
         <div class="carousel-item active">
            <a href="index.php?modulo=donar"><img src="Presentacion\libs\images\carrusel4.jpg" class="d-block img-fluid" alt="..."></a>
            <div class="carousel-caption d-none d-md-block">
               <h5>Ayudanos a construir un mundo mejor para los perritos abandonados</h5>
            </div>
         </div>
         <div class="carousel-item">
            <a href="index.php?modulo=tienda"><img src="Presentacion/libs/images/carrusel2.jpg" class="d-block img-fluid" alt="..."></a>
            <div class="carousel-caption d-none d-md-block">
            </div>
         </div>
         <div class="carousel-item">
            <a href="index.php?modulo=adoptar"><img src="Presentacion/libs/images/carrusel6.jpg" class="d-block img-fluid" alt="..."></a>
            <div class="carousel-caption d-none d-md-block">
            </div>
         </div>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Next</span>
      </button>
   </div>

   <?php
   if (isset($_GET['errorlogin'])) {
   ?>
      <div class="alert alert-danger alert-dismissible fade show " role="alert">
         <strong>Error!</strong> <?php echo $_GET['errorlogin']; ?>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php
   }elseif(isset($_GET['cerrarcuenta'])){
   ?>
      <div class="alert alert-success alert-dismissible fade show float-right" role="alert">
         <strong>Exito!</strong> <?php echo $_GET['cerrarcuenta']; ?>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php
   }
   ?>
   <!-- 
<div class="row d-flex justify-content-center">
   <img class="img-fluid w-50" src="Presentacion/libs/images/PAGINA.jpg" alt="construccion">
</div>
<div class="row d-flex justify-content-center">
   <div class="lds-facebook">
      <div></div>
      <div></div>
   <div></div>
</div>
</div> -->
   <section id="aboutus" class="container-fluid bg-light mx-auto">
      <div class="container pt-0">
         <!-- section heading -->
         <div class="section-heading">
            <h2>Acerca de nosotros</h2>
         </div>
         <!-- /section heading -->
         <div class="row">
            <div class="col-lg-7">
               <p class="lead">Somos un albergue que acoge a decenas de perritos, que han sufrido malos tratos y abandono,
                  que han sido queridos pero ya no pueden ser cuidados y los que simplemente no son deseados.
                  Acogemos a los perritos hasta que podamos encontrarles un hogar permanente y cariñoso.</p>
               <!-- list -->
               <h3 class="my-3">¿Por qué adoptar un perrito del albergue?</h3>
               <ul class="custom pl-0 font-weight-bold">
                  <li>Te brindan amor incondicional.</li>
                  <li>Salvas una vida.</li>
                  <li>Te mantienen activo.</li>
                  <li>Te hacen compañía.</li>
               </ul>
            </div>
            <!-- /col-lg -->
            <div class="col-lg-5 ">
               <!-- image -->
               <img src="Presentacion/libs/images/inicio1.jpg" alt="perro-albergue" class="rounded-circle img-fluid res-margin d-block mx-auto" data-aos="zoom-in">
            </div>
            <!-- /col-lg -->
            <!-- /col-lg -->
         </div>
         <!-- /row -->
      </div>
      <!-- /container -->
   </section>
   <!-- /section ends -->
   <!-- section -->
   <!-- section -->
   <section class="container-fluid">
      <!-- container -->
      <div class="container page-scroll negative-margin-200 ">
         <div class="row mb-3">
            <div class="col-lg-4 icon-box text-center">
               <div class="icon-wrapper bg-icon">
                  <!-- icon -->
                  <i class="flaticon-dog-puppy-sitting-in-front-of-his-man"></i>
               </div>
               <h4> Nuestra visión</h4>
               <p>Una comunidad en la que todos los perritos viven en hogares seguros y cariñosos.</p>
            </div>
            <!-- /col-lg-->
            <div class="col-lg-4 icon-box text-center">
               <div class="icon-wrapper bg-icon">
                  <!-- icon -->
                  <i class="flaticon-man-on-his-knees-to-cuddle-his-dog"></i>
               </div>
               <h4>Nuestra misión</h4>
               <p>Nuestro albergue se dedica a cuidar y realojar a los perritos perdidos y no deseados.</p>
            </div>
            <!-- /col-lg-->
            <div class="col-lg-4 icon-box text-center">
               <div class="icon-wrapper bg-icon">
                  <!-- icon -->
                  <i class="flaticon-running-dog-silhouette"></i>
               </div>
               <h4>Nuestro principio</h4>
               <p>Los perritos del albergue tienen derecho al mismo amor y respeto que ellos nos dan incondicionalmente.</p>
            </div>
            <!-- /col-lg-->
         </div>
         <!-- /row -->
      </div>
      <!-- /container -->
   </section>
   <!-- /section ends -->