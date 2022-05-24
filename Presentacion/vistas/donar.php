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
                     <div class="form-group">
                        <div class="row">
                           <div class="col-md-12 text-light">
                              <label>Nombres</label>
                              <input type="text" name="name" class="form-control input-field" required=""> 
                           </div>
						   <div class="col-md-12 text-light">
                              <label>Apellidos</label>
                              <input type="text" name="name" class="form-control input-field" required=""> 
                           </div>
                           <div class="col-md-12 text-light">
                              <label>Email </label>
                              <input type="email" name="email" class="form-control input-field" required=""> 
                           </div>
						   <div class="col-md-12 text-light">
                              <label>DNI </label>
                              <input type="number" name="dni" class="form-control input-field" required=""> 
                           </div>
                           <div class="col-md-12 text-light">
                              <label>Sube tu váucher</label>
                              <input type="file" name="vaucher" class="form-control input-field"> 
                           </div>
                          
                        </div>
                        <!-- button -->
                        <button type="submit" id="submit_btn" value="Submit" class="btn btn-donation mt-3"">Donar</button>
                     </div>
                     <!-- /form-group-->
                     <!-- Donation results -->
                     <div id="donation_results"></div>
                  </div>
               </div>
               <!-- /col-lg-->
            </div>
            <!-- /row-->   
         </div>
         <!-- /container-->
      </section>
