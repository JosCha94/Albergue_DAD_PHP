<?php
require_once('DAL/conexion.php');
require_once('BL/consultas_post.php');
$conexion = conexion::conectar();
$consulta = new Consulta_post();
$posts = $consulta->listarPost($conexion); // obtenemos todos los posts
?>

<!-- ==== Contenido de blog ==== -->
<div id="blog-home" class="page mt-5">
         <div class="container">   
            <div class="row">
               <!-- Columna de posts-->
               <div class="col-lg-8 page-with-sidebar">
                  <!-- Blog Post -->
                  <?php foreach ($posts as $key => $value) : ?>     <!-- Recorremos todos los posts -->                        
                  <div class="card blog-card ">
                     <!-- informacion Post  -->
                     <div class="post-info mt-3">
                        <ul class="list-inline m-0 p-0"> 
                           <li class="list-inline-item"><?php echo ($value['post_fecha_creacion']); ?></li>
                           <li class="list-inline-item"> Por: <?php echo ($value['post_autor']); ?></li>
                        </ul>
                     </div>
                     <!-- /Informacion post -->
                        <!-- imagen -->
                        <div class="blog-img">
                           <img src="data:image/<?php echo($value['post_tipo_img']);?>;base64,<?php echo base64_encode( $value['post_imagen']); ?>" alt="albergue">
                        </div>
                        <!-- /imagen -->
                     </a>
                     <div class="card-body">
                           <h3 class="card-title "><?php echo ($value['post_titulo']); ?></h3>  <!-- Titulo del post -->
                        </a>
                        <!--descripcion de post -->
                        <p class="card-text mt-3"></p><?php echo ($value['post_descripcion']); ?></p>
                           <form action="index.php?modulo=blog-single" method="post"> 
                              <input type="hidden" value="<?php echo $value['post_id'];?>" name="idPost">       
                              <a href="" class="btn btn-secondary">Leer más &rarr;</a>
                           </form> 
                     </div>                    
                  </div>  
                  <?php endforeach; ?>      
                  <!-- /Blog Post -->             
               </div>
               <!-- /columna de posts-->
               <!-- /pagina-con-sidebar -->
               <!-- Sidebar -->
               <div id="sidebar" class="h-100 col-lg-4 card">
                  <!--widget-area -->
                  <div class="widget-area">
                     <h5 class="sidebar-header">Buscar</h5>
                     <div class="input-group">
                        <input type="text" class="form-control border border-secondary" placeholder="">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary btn-sm" type="button">Ir</button>
                        </span>
                     </div>
                  </div>                 
               
                  <!--/widget-area -->
                  <div class="widget-area mt-3">
                     <h5 class="sidebar-header">Síguenos</h5>
                     <div class="contact-icon-info">
                        <!--  Links  redes sociales-->
                        <ul class="social-list text-center list-inline">
                           <li class="list-inline-item"><a title="Facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                           <li class="list-inline-item"><a title="Twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                           <li class="list-inline-item"><a  title="Instagram" href="#"><i class="fab fa-instagram"></i></a></li>                         
                        </ul>
                        <!-- / Links  redes sociales-->
                     </div>
                     <!--/contact-icon-info -->
                  </div>
                  <!--/widget-area -->
               </div>
               <!--/sidebar -->      
            </div>
            <!-- /.row -->
         </div>
         <!-- /.container -->
      </div>
      <!-- /pagina-->