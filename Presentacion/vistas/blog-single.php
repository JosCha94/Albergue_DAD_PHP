<?php
require_once('DAL/conexion.php');
require_once('BL/consultas_post.php');
$conexion = conexion::conectar();
$consulta = new Consulta_post();
$idPost = $_POST['idPost']; // id del post que se quiere mostrar
$id = $idPost;
$post = $consulta->mostrarPost($conexion, $id); // obtenemos el post que se quiere mostrar

?>

<!-- ==== Pagina Contenido de post==== -->
<div class="page mt-5">
          <!-- .container -->
         <div class="container">
            <!-- .row -->
            <div class="row">
               <!-- Columna post-->
               <div class="col-lg-8  page-with-sidebar">
                  <!-- Titulo del post -->
                  <h2 class="mb-2"><?php echo $post['post_titulo'] ?></h2>  
                  <!-- Informacion post-->
                  <div class="post-info text-muted">
                     <ul class="list-inline m-0 p-0"> 
                          <!-- Fecha de creacion del post -->
                        <li class="list-inline-item"><?php echo $post['post_fecha_creacion'] ?></li> 
                        <!-- Autor del post -->
                        <li class="list-inline-item"> Por: <?php echo $post['post_autor'] ?></li>  
                     </ul>
                  </div>
                  <hr>
                   <!-- Imagen del post -->
                  <img src="data:image/<?php echo($post['post_tipo_img']);?>;base64,<?php echo base64_encode( $post['post_imagen']); ?>" alt="albergue">
                  <hr>
                  <!-- Descripcion del post -->
                  <p class="lead text-primary"> <?php echo $post['post_descripcion'] ?></p>  
                  <!-- Formulario de comentarios -->
                  <div class="card my-4 mt-5 bg-light">
                     <h5 class="card-header">Comentarios:</h5>
                     <div class="card-body">
                        <form>
                           <div class="form-group mb-3">
                              <input type="text" class="form-control"  placeholder="Nombre">
                           </div>
                           <div class="form-group">
                              <input type="text" class="form-control mb-3"  placeholder="Email">
                           </div>
                           <div class="form-group">
                              <textarea class="form-control mb-3" rows="3"  placeholder="Comentario"></textarea>
                           </div>
                           <button type="submit" class="btn btn-secondary">Enviar</button>
                        </form>
                     </div>
                  </div>
                   <!-- Formulario de comentarios -->                
               </div>
               <!-- /sidebar  de pagina-->
               <!-- Sidebar -->
               <div id="sidebar" class="h-100 col-lg-4 card">
                  <!--widget- -->
                  <div class="widget-area">
                     <h5 class="sidebar-header">Buscar</h5>
                     <div class="input-group">
                        <input type="text" class="form-control border border-secondary" placeholder="">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary btn-sm " type="button">Ir</button>
                        </span>
                     </div>
                  </div>
                 <!--widget-area -->
                  <div class="widget-area">
                     <h5 class="sidebar-header">Síguenos</h5>
                     <div class="contact-icon-info">
                        <!-- Links redes sociales-->
                        <ul class="social-list text-center list-inline">
                           <li class="list-inline-item"><a title="Facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                           <li class="list-inline-item"><a title="Twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                           <li class="list-inline-item"><a  title="Instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                          
                        </ul>
                        <!-- /Fin links redes sociales-->
                     </div>
                     <!--/contactos-icon-info -->
                  </div>
                  <!--/widget-area -->
               </div>
               <!--/sidebar -->      
            </div>
            <!-- /.row -->
         </div>
         <!-- /.container -->
      </div>
      <!-- /page -->