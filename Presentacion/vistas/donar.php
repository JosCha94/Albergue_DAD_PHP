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
   // archivo temporal (ruta y nombre)
   $tmp_name = $_FILES['vaucher']['tmp_name'];
   // Obtenemos los datos de la imagen tamaño, tipo y nombre
   $tamano = $_FILES['vaucher']['size'];  
   $tipo = $_FILES['vaucher']['type'];   
   $nombre = $_FILES['vaucher']["name"];  
   //ruta completa
   $archivo_temporal = $_FILES['vaucher']['tmp_name'];  
   //leer el archivo(imagen) temporal en binario  
   $fp = fopen($archivo_temporal, 'r+b');   
   $vaucher = fread($fp, filesize($archivo_temporal)); 
   $monto = $_POST['monto'];
   $don = new Donacion($nombres, $apellidos,  $correo, $celular, $vaucher, $monto);
   $consulta = new Consulta_donacion();
   $estado = $consulta->SP_insertar_donacion($conexion, $don);
   if ($estado == 'mal') {
      echo '<div class="alert alert-success">Su donación fue enviada exitosamente.</div>';
   }
}
?>

<section id="donation" class="container-fluid mt-5">
         <div class="container">
		  <div class="section-heading text-center">
               <h2>Donar</h2>
            </div>
            <div class="row">
               <div class="col-lg-6">
                  <h4>Sigue estos pasos para donar:</h4>
                  <p>Llena el formulario con tus datos y la captura del váucher de tu donación.</p>                   
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
               <div class="col-lg-6 p-5 res-margin bg-secondary h-50">
                  <h4 class="text-light">¡Muchas gracias por tu ayuda!</h4>
                  <!-- Form Starts -->
                  <div id="donation_form">
                  <form action="" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-12 text-light">
                              <label>Nombre</label>
                              <input type="text" name="nombre" class="form-control input-field" minlength="4" maxlength="50" placeholder="Ingresa tu nombre"required=""> 
                           </div>
						         <div class="col-md-12 text-light">
                              <label>Apellido</label>
                              <input type="text" name="apellido" class="form-control input-field" minlength="4" maxlength="50" placeholder="Ingresa tu apellido" required=""> 
                           </div>
                           <div class="col-md-12 text-light">
                              <label>Correo Electrónico</label>
                              <input type="email" name="email" class="form-control input-field" minlength="4" maxlength="50" placeholder="Ingresa tu correo electrónico" required=""> 
                           </div>
                           <div class="col-md-12 text-light">
                              <label>Celular</label>
                              <input type="text" name="celular" class="form-control input-field" minlength="9" placeholder="Ingresa tu número de celular" required=""> 
                           </div>
                           <div class="col-md-12 text-light">
                              <label>Sube tu váucher</label>
                              <input type="file" name="vaucher" class="form-control input-field"> 
                           </div> 
                           <div class="col-md-12 text-light">
                              <label>Monto donado </label>
                              <input type="text" name="monto" class="form-control input-field" maxlength="4" placeholder="Ingresa el monto de tu donación" required=""> 
                           </div>                           
                        </div>
                        <!-- button -->
                        <button type="submit" id="submit_btn" value="Submit" class="btn btn-donation mt-3"">Donar</button>
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
