<?php
switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($rol != 'true'):
        $error = 'No tiene activado el rol de Cliente';
        break;
}
?>
<?php if ($error == 'SinError') : ?>
    <?php
    require_once('BL/consultas_usuario.php');
    require_once 'ENTIDADES/usuario.php';
    require_once('DAL/conexion.php');
    $conexion = conexion::conectar();
    $consulta = new Consulta_usuario();
    $id = $_SESSION['usuario'][0];
    $usuario = $consulta->detalleUsuario($conexion, $id);
    ?>
    <div class="row my-md-4">
        <h1 class="text-center my-4">HOLA <?php echo ($usuario['usuario']); ?></h1>
        <div class="col-12 col-md-4 bg-warning p-3 position-relative">
            <h3 class="text-center">Datos del usuario</h3>

            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col-auto d-none d-lg-block">
                    <img class="img-circle mx-5 mt-3" src="Presentacion\libs\images\perrito_adopt.jpg" width="250" height="250" alt="">
                    <h3 class="mb-0 text-center mt-2"><?php echo ($usuario['usuario']); ?></h3>
                </div>
                <div class="col p-4 mt-2 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 text-success">Nombre: <?php echo ($usuario['usr_nombre']); ?></strong>
                    <div class="mb-1 text-muted">Apellidos: <?php echo ($usuario['usr_apellido_paterno'] . '' . $usuario['usr_apellido_materno']); ?></div>
                    <div class="mb-1 text-muted">Celular: <?php echo ($usuario['usr_celular']); ?></div>
                    <div class="mb-1 text-muted">E-mail: <?php echo ($usuario['usr_email']); ?></div>
                </div>
                <div class="my-3">
                    <a class="btn btn-primary w-100 my-4 my-md-2 mx-auto" href="index.php?modulo=update-user&formTipo=dataUser" id="btn-changedata">Cambiar datos</a>
                    <a class="btn btn-danger w-100 my-2 mx-auto" href="index.php?modulo=update-user&formTipo=passUser" id="btn-changedata">Cambiar contraseña</a>
                </div>

            </div>
            <div class="<?php echo ($section != '') ? 'position-absolute bottom-0' : '' ?>">
                <h6>Fecha de creacion: <span class="h6 text-danger"><?php echo ($usuario['usr_fecha_creacion']); ?></span></h6>
                <br>
                <h6>Ultima actualización: <span class="h6 text-danger"><?php echo ($usuario['usr_fecha_modificacion']); ?></span></h6>

            </div>
        </div>
        <div class="col-12 col-md-8 bg-primary p-3">
            <div class="col-12 bg-danger p-5 my-1">
                <h3 class="text-center">Adopcion</h3>
            </div>
            <div class="col-12 bg-warning p-5 my-1">
                <h3 class="text-center">Suscripcion Padrino</h3>
            </div>
            <div class="col-12 bg-success p-5 my-1">
                <h3 class="text-center">Mis compras</h3>
            </div>
            <div class="col-12 border border-dark d-none p-5 my-1" id="formData">
                <h3>INGRESA TUS DATOS PARA CAMBIAR</h3>
                <form action="" method="POST">
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
                    <div class="form-group">
                        <label for="usr_nombre">NICK DE USUARIO</label>
                        <input type="text" class="form-control" id="nick_user" name="nick_user" value="<?php if (isset($user)) {
                                                                                                            echo $user;
                                                                                                        } else {
                                                                                                            echo ($usuario['usuario']);
                                                                                                        } ?>">
                    </div>
                    <div class="form-group">
                        <label for="usr_nombre">Nombre</label>
                        <input type="text" class="form-control" id="usr_nombre" name="usr_nombre" value="<?php if (isset($name)) {
                                                                                                                echo $name;
                                                                                                            } else {
                                                                                                                echo ($usuario['usr_nombre']);
                                                                                                            } ?>">
                    </div>
                    <div class="form-group">
                        <label for="usr_apellido_paterno">Apellido Paterno</label>
                        <input type="text" class="form-control" id="usr_apellido_paterno" name="usr_apellido_paterno" value="<?php if (isset($ape_p)) {
                                                                                                                                    echo $ape_p;
                                                                                                                                } else {
                                                                                                                                    echo ($usuario['usr_apellido_paterno']);
                                                                                                                                } ?>">
                    </div>
                    <div class="form-group">
                        <label for="usr_apellido_materno">Apellido Materno</label>
                        <input type="text" class="form-control" id="usr_apellido_materno" name="usr_apellido_materno" value="<?php if (isset($ape_m)) {
                                                                                                                                    echo $ape_m;
                                                                                                                                } else {
                                                                                                                                    echo ($usuario['usr_apellido_materno']);
                                                                                                                                } ?>">
                    </div>
                    <div class="form-group">
                        <label for="usr_celular">Celular</label>
                        <input type="text" class="form-control" id="usr_celular" name="usr_celular" value="<?php if (isset($celu)) {
                                                                                                                echo $celu;
                                                                                                            } else {
                                                                                                                echo ($usuario['usr_celular']);
                                                                                                            } ?>">
                    </div>
                    <div class="form-group">
                        <label for="usr_email">E-mail</label>
                        <input type="text" class="form-control" id="usr_email" name="usr_email" value="<?php if (isset($email)) {
                                                                                                            echo $email;
                                                                                                        } else {
                                                                                                            echo ($usuario['usr_email']);
                                                                                                        } ?>">
                    </div>
                    <button class="btn btn-primary my-3" name="actualizar_data">Actualizar</button>
                    <button type="reset" class="btn btn-danger my-3 mx-3" id="btn-cleanFormData">Limpiar</button>
            </div>

            <div class="col-12 border border-dark  p-5  my-1 d-none" id="formPass">
                <h3>INGRESA TU NUEVA CONTRASEÑA</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="usr">Contraseña:</label>
                        <input type="password" class="form-control" id="pass" name="pass" placeholder="Ingresa tu contraseña">
                    </div>
                    <div class="form-group">
                        <label for="usr2">Repite tu contraseña:</label>
                        <input type="password" class="form-control" id="pass2" name="pass2" placeholder="Repite tu contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary my-3">Cambiar contraseña</button>
                    <button type="reset" class="btn btn-warning my-3 mx-3" id="btn-cleanFormPass">Limpiar</button>
                </form>
            </div>
        </div>
    </div>
<?php else : ?>

    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>

<?php endif; ?>