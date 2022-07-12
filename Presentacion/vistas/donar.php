<?php
require_once('BL/consultas_donacion.php');
require_once 'ENTIDADES/donacion.php';
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
if (isset($_POST['submit_btn_donacion'])) {   
   $nombres = $_POST['nombres'];
   $apellidos = $_POST['apellidos'];
   $correo = $_POST['correo'];
   $celular = $_POST['celular'];
   $monto = $_POST['monto'];
   /*
   // archivo temporal (ruta y nombre)
   $tmp_name = $_FILES['vaucher']['tmp_name'];
   // Obtenemos los datos de la imagen tamaño, tipo y nombre
   $tamano = $_FILES['vaucher']['size'];  
   $nombre_img = $_FILES['vaucher']["name"];  
   $tipo_img = $_FILES['vaucher']['type'];   
   //ruta completa
   $archivo_temporal = $_FILES['vaucher']['tmp_name']; 
   //abrir el archivo temporal en modo lectura binaria 
   $fp = fopen($archivo_temporal, 'rb');     
    //leer el archivo(imagen) temporal en binario  
   $vaucher = fread($fp, filesize($archivo_temporal));    
   fclose($fp);
   */
   $data = $_FILES['vaucher'];     //data es un array que contiene los datos de la imagen  
   $vaucher = file_get_contents($_FILES['vaucher']['tmp_name']); //obtenemos el contenido del archivo
   $nombre_img = $_FILES ['vaucher']['name']; //nombre de la imagen que se subio   
   $tipo_img = $_FILES ['vaucher']['type']; //tipo de imagen que se subio
   $ext = explode('.', $nombre_img);
   $extR = strtolower(end($ext));
   $tamano_img= $_FILES ['vaucher']['size'];   //tamaño de la imagen que se subio
   $don = new Donacion($nombres, $apellidos, $correo, $celular, $vaucher, $extR, $monto);   //creamos un objeto de la clase donacion
   $consulta = new Consulta_donacion(); //creamos un objeto de la clase consulta_donacion
   $errores = $consulta->validar_donacion($don);  //llamamos al metodo validar_donacion de la clase consulta_donacion
   if (count($errores) == 0) {    //si no hay errores
      $estado = $consulta->insertarDonacion($conexion, $don);    //insertamos la donacion
         if(!$estado){
            echo "<meta http-equiv='refresh' content='3'>";
            echo '<div class="alert alert-success">¡Su donación fue enviada exitosamente!.</div>';
         }else{
            echo "<meta http-equiv='refresh' content='3'>";
            echo '<div class="alert alert-success">¡Hubo un error al momento de almacenar la informacion, intentelo de nuevo por favor!.</div>';
         }
   } else {
      echo '<div class="alert alert-danger">Hubo un error al momento de validar los datos ingresados</div>';
      
   }
}

?>
<section id="donation" class="container-fluid my-5">
   <div class="texto-imagen text-center mb-5">
      Apoyanos con una donación
      <p class="h6">Ayuda a los perros de la calle, dales una oportunidad</p>
 </div>
   <div class="container">
      <div class="row">
         <div class="col-lg-6 dona-data">
            <div class="section-heading text-center">
               <h2 class="my-3">Donar</h2>
            </div>
            <h2>Sigue estos pasos para donar:</h2>
            <p class="h5">Llena el formulario con tus datos y adjunta la captura del váucher de tu donación.</p>                   
            <div class="row">
            <div class="col-sm-12">
               <!-- Bank accounts List -->
               <h5 class="mt-4">Cuentas Bancarias</h5>
               <ul class="custom pl-0">
                  <li>Cuenta corriente en soles BCP: 978-998889-54894-55</li>
                  <li>Cuenta corriente en soles Scotiabank: 144-8989-8884-22</li>
                  <li>Cuenta corriente en soles BBVA: 785-48875-588-55</li>               
               </ul>                   
            </div>                
         </div>
               
            </div>
            <!-- donation box -->  
            <div class="col-lg-6 res-margin  h-50">
               <!-- Form Starts -->
               <div id="donation_form">
                  <form class="dona-form form-control p-5 bg-secondary bg-opacity-75 shadow-lg" action="" method="post" enctype="multipart/form-data">
                  <h4 class="text-center">¡Muchas gracias por tu ayuda!</h4>
               <?php if (isset($errores)) : ?>
                     <?php if(count($errores) != 0) : ?>
                           <ul class="alert alert-danger mt-3">
                              <?php foreach ($errores as  $error) : ?>
                                 <li><?= $error; ?></li>
                              <?php endforeach; ?>
                           </ul>
                           <?php else : ?>
                           <div class="alert alert-success mt-3">
                              <p>Su donación se envió exitosamente.</p>
                           </div>
                     <?php endif; ?>
                  <?php endif; ?>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-12">
                           <label>Nombres</label>
                           <input type="text" name="nombres" class="form-control input-field" minlength="4" maxlength="50" value="<?php if (isset($nombres)) echo $nombres ?>" placeholder="Ingresa tu nombre"required> 
                        </div>
                        <div class="col-md-12">
                           <label>Apellidos</label>
                           <input type="text" name="apellidos" class="form-control input-field" minlength="4" maxlength="50" value="<?php if (isset($apellidos)) echo $apellidos ?>" placeholder="Ingresa tu apellido" required> 
                        </div>
                        <div class="col-md-12">
                           <label>Correo Electrónico</label>
                           <input type="email" name="correo" class="form-control input-field" minlength="4" maxlength="50" value="<?php if (isset($correo)) echo $correo ?>"placeholder="Ingresa tu correo electrónico" required> 
                        </div>
                        <div class="col-md-12">
                           <label>Celular</label>
                           <input type="text" name="celular" class="form-control input-field" maxlength="9"  value="<?php if (isset($celular)) echo $celular ?>"placeholder="Ingresa tu número de celular" required> 
                        </div>
                        <div class="col-md-12t">
                           <label>Monto donado</label>
                           <input type="number" step="0,01" name="monto" class="form-control input-field" placeholder="Monto donado en soles"required> 
                        </div>
                        <div class="col-md-12">
                           <label>Sube tu váucher</label>
                           <input type="file" name="vaucher" class="form-control input-field" > 
                        </div>                     
                     </div>
                     <!-- button -->
                     <button type="submit" name="submit_btn_donacion"  class="btn btn-donation mt-3">Donar</button>
                  </div>
                  <!-- /form-group-->                    
                  </form>
               </div>
            </div>
            <!-- /col-lg-->
         </div>
         <!-- /row-->   
      </div>
      <!-- /container-->
</section>
<!-- /donation-->
