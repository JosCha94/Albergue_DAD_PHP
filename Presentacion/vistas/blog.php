<?php
require_once('DAL/conexion.php');
require_once('BL/consultas_post.php');
$conexion = conexion::conectar();
$consulta = new Consulta_post();
$posts = $consulta->listarPost($conexion); // obtenemos todos los posts

if (in_array(4,$PermisosVistaPag)):
?>


<!-- ==== Contenido de blog ==== -->
<div class="bg-blog">
<div class="jumbotron-blog">
            <!-- Heading -->
<div class="jumbo-heading">
      <h1>BLOG</h1>
</div>
</div>
         
<div id="blog-home" class="page-blog">
   <div class="container "> 
 
      <div class="row">
         <!-- Columna de posts-->
         <?php foreach ($posts as $key => $value) : ?>     <!-- Recorremos todos los posts -->                        
         <div class="col-lg-4 page-with-sidebar p-0 mb-5">
            <!-- Blog Post -->
            <div class="card blog-card mx-4 mb-2">
               <!-- informacion Post  -->
               <div class="post-info mt-3">
                  <ul class="list-inline m-0 p-0"> 
                     <li class="list-inline-item"><?php echo date("Y/m/d") . "<br>"; ($value['post_fecha_creacion']); ?></li>
                     <li class="list-inline-item"> Por: <?php echo ($value['post_autor']); ?></li>
                  </ul>
               </div>
               <!-- /Informacion post -->
                  <!-- imagen -->
                  <div class="blog-img">
                     <img src="data:image/<?php echo ($value['post_img_tipo']); ?>;base64,<?php echo base64_encode($value['post_img']); ?>" alt="<?= $value['post_titulo']; ?>" class="img-fluid">
                  </div>
                  <!-- /imagen -->
               </a>
               <div class="card-body">
                  <!-- Titulo del post -->
                     <h3 class="card-title "><?php echo ($value['post_titulo']); ?></h3>  
                     <form action="index.php?modulo=blog-single" method="post">       
                        <input type="hidden" value="<?php echo $value['post_id'];?>" name="idPost">          
                        <button type="submit" class="btn btn-donation mt-5">Leer más &rarr;</a>
                     </form> 
               </div>                    
            </div>  
            <!-- /Blog Post -->             
         </div>
         <?php endforeach; ?>      
         <!-- /columna de posts-->
         <!-- /pagina-con-sidebar -->
         <!-- Sidebar -->
        
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container -->
</div>
<!-- /pagina-->
</div>
<?php else : ?>
<!-- <div class="container"> -->
    <div class="row">
        
        <img src="Presentacion\libs\images\mantenimiento-web.png" alt="pagina en mantenimiento" class="img-fluid mt-5 mx-auto">
        </div>
    <!-- </div> -->
    
<?php endif; ?>
