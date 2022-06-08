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
<?php if ($error == 'SinError'): ?>
<?php
    require_once('BL/consultas_usuario.php');
    require_once 'ENTIDADES/usuario.php';
    require_once('DAL/conexion.php');
    $formTipo = $_GET['formTipo'] ?? '';
    $conexion = conexion::conectar();
    $consulta = new Consulta_usuario();
    $id = $_SESSION['usuario'][0];
    $usuario = $consulta->detalleUsuario($conexion, $id);

    if (isset($_POST['actualizar_data'])) {
        $user = $_POST['nick_user'];
        $pass = 123456789;
        $name = $_POST['usr_nombre'];
        $ape_p = $_POST['usr_apellido_paterno'];
        $ape_m = $_POST['usr_apellido_materno'];
        $email = $_POST['usr_email'];
        $celu = $_POST['usr_celular'];
        $usu = new usuario($user, $pass,  $name, $ape_p, $ape_m, $email, $celu);
        $consulta = new Consulta_usuario();
        $errores = $consulta->Validar_registro($usu);
        if (count($errores) == 0) {
              $estado = $consulta->actualizar_usuario($conexion, $id, $usu);

            if ($estado == 'mal') {
            } else {
                echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=update-user&formTipo=dataUser&mensaje=El Usuario se actualizo correctamente" />';
            }
        }
    }
?>
<?php if ($formTipo == 'dataUser') : ?>
        <div class="col-12 col-md-8 border border-dark p-5 mx-auto my-4 bg-primary" id="formData">
            <h3>INGRESA TUS DATOS PARA CAMBIAR</h3>
            <form action="" method="POST">
                <?php if (isset($errores)) : ?>
                    <?php if (count($errores) != 0) : ?>
                        <ul class="alert alert-danger mt-3">
                            <h1>Corregir</h1>
                            <?php foreach ($errores as  $error) : ?>
                                <li class="ms-2"><?= $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="form-group">
                    <label for="usr_nombre">NICK DE USUARIO</label>
                    <input type="text" class="form-control" id="nick_user" name="nick_user" maxlength="15" minlength="5" value="<?php if (isset($user)) {
                    echo $user;} else {echo ($usuario['usuario']);} ?>">
                </div>
                <div class="form-group">
                    <label for="usr_nombre">Nombre</label>
                    <input type="text" class="form-control" id="usr_nombre" name="usr_nombre" minlength="4" maxlength="20" value="<?php if (isset($name)) {
                    echo $name;} else {echo ($usuario['usr_nombre']); } ?>">
                </div>
                <div class="form-group">
                    <label for="usr_apellido_paterno">Apellido Paterno</label>
                    <input type="text" class="form-control" id="usr_apellido_paterno" name="usr_apellido_paterno" minlength="4" maxlength="20" value="<?php if (isset($ape_p)) {echo $ape_p;} else {echo ($usuario['usr_apellido_paterno']);} ?>">
                </div>
                <div class="form-group">
                    <label for="usr_apellido_materno">Apellido Materno</label>
                    <input type="text" class="form-control" id="usr_apellido_materno" name="usr_apellido_materno" minlength="4" maxlength="20" value="<?php if (isset($ape_m)) {echo $ape_m;} else {echo ($usuario['usr_apellido_materno']);} ?>">
                </div>
                <div class="form-group">
                    <label for="usr_email">E-mail</label>
                    <input type="text" class="form-control" id="usr_email" name="usr_email" maxlength="30" value="<?php if (isset($email)) {
                    echo $email;} else {echo ($usuario['usr_email']);} ?>">
                </div>
                <div class="form-group">
                    <label for="usr_celular">Celular</label>
                    <input type="text" class="form-control" id="usr_celular" name="usr_celular" maxlength="9" minlength="9" value="<?php if (isset($celu)) {
                    echo $celu;} else {echo ($usuario['usr_celular']);} ?>">
                </div>
                
                <button class="btn btn-primary my-3" name="actualizar_data">Actualizar</button>
                <button type="reset" class="btn btn-danger my-3 mx-3" id="btn-cleanFormData">Limpiar</button>
            </form>
        </div>

    <?php elseif ($formTipo == 'passUser') : ?>
        <div class="col-12 col-md-8 border border-dark  p-5  my-4 mx-auto" id="formPass">
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

    <?php endif; ?>
<?php else : ?>
    
    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>

<?php endif; ?>
