<section id="donation" class="container-fluid mt-5">
    <div class="container">
        <div class="section-heading text-center">
            <h2>Nuevo usuario</h2>
        </div>
        <div class="row">
            <!-- donation box -->
            <div class="col-lg-6 p-5 res-margin bg-secondary h-50 mx-auto">
                <h4 class="text-light">¡Registrate!</h4>

                <!-- Form Starts -->
                <div id="donation_form">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 text-light">
                                <label>Usuario</label>
                                <input type="text" name="user" class="form-control input-field" maxlength="15" minlength="5" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Contraseña</label>
                                <input type="password" name="pass" class="form-control input-field" maxlength="15" minlength="8" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Nombre </label>
                                <input type="text" name="name" class="form-control input-field" minlength="4" maxlength="20" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Apellido Paterno </label>
                                <input type="text" name="ape_p" class="form-control input-field" minlength="4" maxlength="20" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Apellido Materno </label>
                                <input type="text" name="ape_m" class="form-control input-field" minlength="4" maxlength="20" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Correo electronico </label>
                                <input type="email" name="email" class="form-control input-field" maxlength="30" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Telefono celular </label>
                                <input type="tel" name="celu" class="form-control input-field" maxlength="9" minlength="9" required="">
                            </div>
                        </div>
                        <!-- button -->
                        <div class="mt-3 d-flex justify-content-around">
                            <button type="submit" id="submit_btn" value="Submit" class="btn btn-donation mt-3">Registrase</button>
                            <button type="reset" id="submit_btn" value="Submit" class="btn btn-danger size-btn mt-3">Limpiar</button>
                        </div>
                    </form>
                    <!-- /form-group-->
                    <!-- Donation results -->
                </div>
            </div>
            <!-- /col-lg-->
        </div>
        <!-- /row-->
    </div>
    <!-- /container-->
</section>