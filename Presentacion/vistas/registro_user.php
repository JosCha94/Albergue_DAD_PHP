<?php
require_once('BL/consultas_usuario.php');
require_once 'ENTIDADES/usuario.php';
require_once('DAL/conexion.php');
$conexion = conexion::conectar();
if (isset($_POST['registro_usr'])) {
    $user = $_POST['user'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $ape_p = $_POST['ape_p'];
    $ape_m = $_POST['ape_m'];
    $email = $_POST['email'];
    $celu = $_POST['celu'];
    $usu = new usuario($user, $pass,  $name, $ape_p, $ape_m, $email, $celu);
    $consulta = new Consulta_usuario();
    $errores = $consulta->Validar_registro($usu);
    if (count($errores) == 0) {
        $estado = $consulta->insetar_usuario($conexion, $usu);

        if ($estado == 'mal') {
        } else {
            echo '<meta http-equiv="refresh" content="0; url=../index.php?modulo=inicio&mensaje=El Usuario se registro correctamente" />';
        }
    }
}
?>
<section id="dormRegistro" class="container-fluid mt-5">
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
                        <?php if (isset($errores)) : ?>
                            <?php if (count($errores) != 0) : ?>
                                <ul class="alert alert-danger mt-3">
                                    <h1>Corregir</h1>
                                    <?php foreach ($errores as  $error) : ?>
                                        <li><?= $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else : ?>
                                <!-- <div class="alert alert-success mt-3">
                                <p>¡Registro exitoso!</p>
                            </div> -->
                            <?php endif; ?>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-md-12 text-light">
                                <label>Usuario</label>
                                <input type="text" name="user" class="form-control input-field" maxlength="15" minlength="5" value="<?php if (isset($user)) echo $user ?>" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Contraseña</label>
                                <input type="password" name="pass" class="form-control input-field" maxlength="15" minlength="8" value="<?php if (isset($pass)) echo $pass ?>" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Nombre </label>
                                <input type="text" name="name" class="form-control input-field" minlength="4" maxlength="20" value="<?php if (isset($name)) echo $name ?>" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Apellido Paterno </label>
                                <input type="text" name="ape_p" class="form-control input-field" minlength="4" maxlength="20" value="<?php if (isset($ape_p)) echo $ape_p ?>" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Apellido Materno </label>
                                <input type="text" name="ape_m" class="form-control input-field" minlength="4" maxlength="20" value="<?php if (isset($ape_m)) echo $ape_m ?>" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Correo electronico </label>
                                <input type="email" name="email" class="form-control input-field" maxlength="30" value="<?php if (isset($email)) echo $email ?>" required="">
                            </div>
                            <div class="col-md-12 text-light">
                                <label>Telefono celular </label>
                                <input type="tel" name="celu" class="form-control input-field" maxlength="9" minlength="9" value="<?php if (isset($celu)) echo $celu ?>" required="">
                            </div>
                            <div class="form-check d-flex justify-content-center mt-3">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required />
                                <label class="form-check-label" for="form2Example3">
                                    Estoy de acuerdo con los <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal">Terminos y condiciones</a>
                                </label>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Terminos y condiciones</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Why do we use it?
                                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).


                                        Where does it come from?
                                        Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                                    </div>
                                    <div class="modal-footer">
                                        <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- button -->
                        <div class="mt-3 d-flex justify-content-around">
                            <button type="submit" name="registro_usr" value="Submit" class="btn btn-donation mt-3">Registrase</button>
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