<?php
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [1]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [1]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($permisoEsp == 'true'):
        break;
    case ($rolActi != 'true'):
        $error = 'No tiene activado el rol de Cliente';
        break;
}
?>
<?php if ($error == 'SinError') : ?>
<?php
require_once('DAL/conexion.php');
require_once('BL/consultas_post.php');
$conexion = conexion::conectar();
$consulta = new Consulta_post();
if ($_POST['idPost'] != '') :
   $idPost = $_POST['idPost']; // id del post que se quiere mostrar
   $_SESSION['usuario'][6] = $idPost; // se guarda el id del post en la variable de sesion
else :
   $idPost = $_SESSION['usuario'][6];
endif;
$post = $consulta->mostrarPost($conexion, $idPost); // obtenemos el post que se quiere mostrar
$comentarios = $consulta->listarComentariosPost($conexion, $idPost); // obtenemos el post que se quiere mostrar

if (isset($_POST['registro_comentario'])) {
   $PostID = $idPost;
   $user = $info->user_name;
   $coment = $_POST['post_comentario'];
   $estadop = $consulta->insetar_post($conexion, $PostID, $user, $coment);

   if ($estadop == 1) {
?>
      <div class="alert alert-danger alert-dismissible fade show " role="alert">
         <strong>Error!</strong> no se pudo agregar el comentario
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
   <?php
   } elseif ($estadop == 2) {
      echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=blog-single&mensaje=Se agrego el comentario al post" />';
   }
}

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
                  <li class="list-inline-item"><?php echo date("Y/m/d") . "<br>";
                                                $post['post_fecha_creacion'] ?></li>
                  <!-- Autor del post -->
                  <li class="list-inline-item"> Por: <?php echo $post['post_autor'] ?></li>
               </ul>
            </div>
            <hr>
            <!-- Imagen del post -->
            <img src="data:image/<?php echo ($post['post_img_tipo']); ?>;base64,<?php echo base64_encode($post['post_img']); ?>" alt="<?= $post['post_titulo']; ?>" class="img-fluid ">
            <hr>
            <!-- Descripcion del post -->
            <p class="lead text-primary"> <?php echo $post['post_descripcion'] ?></p>
            <!-- Comentarios -->
            <div class="card my-4 mt-5 bg-light">
               <h5 class="card-header">Comentarios:</h5>
               <div class="card-body">
                  <ul class="list-group">
                     <?php foreach ($comentarios as $key => $value) : ?>
                        <li class="list-group-item">
                           <div class="media">
                              <div class="media-body">
                                 <h5 class="mt-0"><?php echo $value['user_nombre'] ?></h5>
                                 <?php echo $value['comentario'] ?>
                              </div>
                           </div>
                        </li>
                     <?php endforeach; ?>
                  </ul>
               </div>
            </div>
            <!-- Formulario de comentarios -->
            <div class="card my-4 mt-5 bg-light">
               <h5 class="card-header">Dejanos un Comentario:</h5>
               <div class="card-body">
                  <form action=" " method="post">
                     <div class="form-group mb-3">
                        <input type="text" class="form-control" placeholder="Nombre" value="<?php echo $info->user_name ?>" name="autor_comentario" disabled>
                     </div>
                     <div class="form-group">
                        <textarea class="form-control mb-3" rows="3" placeholder="Comentario" name="post_comentario"></textarea>
                     </div>
                     <input type="hidden" name="post" value="<?php echo $idPost ?>">
                     <button type="submit" class="btn btn-secondary" name="registro_comentario">Enviar</button>
                  </form>
               </div>
            </div>
            <!-- Formulario de comentarios -->
         </div>
         <!-- /sidebar  de pagina-->
         <!-- Sidebar -->
         <!-- <div id="sidebar" class="h-100 col-lg-4 card"> -->
         <!--widget- -->
         <!-- <div class="widget-area">
                     <h5 class="sidebar-header">Buscar</h5>
                     <div class="input-group">
                        <input type="text" class="form-control border border-secondary" placeholder="">
                        <span class="input-group-btn">
                        <button class="btn btn-secondary btn-sm " type="button">Ir</button>
                        </span>
                     </div>
                  </div> -->
         <!--widget-area -->
         <!-- <div class="widget-area">
                     <h5 class="sidebar-header">Síguenos</h5>
                     <div class="contact-icon-info"> -->
         <!-- Links redes sociales-->
         <!-- <ul class="social-list text-center list-inline">
                           <li class="list-inline-item"><a title="Facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                           <li class="list-inline-item"><a title="Twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                           <li class="list-inline-item"><a  title="Instagram" href="#"><i class="fab fa-instagram"></i></a></li>
                          
                        </ul> -->
         <!-- /Fin links redes sociales-->
         <!-- </div> -->
         <!--/contactos-icon-info -->
         <!-- </div> -->
         <!--/widget-area -->
         <!-- </div> -->
         <!--/sidebar -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container -->
</div>
<!-- /page -->
<?php else : ?>

<div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
</div>

<?php endif; ?>