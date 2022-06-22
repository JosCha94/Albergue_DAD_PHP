<?php
switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($rolActi != 'true'):
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
    $pedidos = $consulta->select_pedidos($conexion, $id);
    ?>
    <div class="row my-md-4">
        <h1 class="text-center my-4">HOLA <?php echo ($usuario['usuario']); ?></h1>
        <div class="col-12 col-md-4 bg-primary p-3 position-relative">
            <h3 class="text-center">Datos del usuario</h3>

            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col-auto d-none d-lg-block">
                    <img class="img-circle mx-5 mt-3" src="Presentacion\libs\images\perrito_adopt.jpg" width="250" height="250" alt="">
                    <h3 class="mb-0 text-center  mt-2"><?php echo ($usuario['usuario']); ?></h3>
                </div>
                <div class="col p-4 mt-2 d-flex flex-column position-static">
                    <!-- <strong class="d-inline-block mb-2 text-white">Nombre: <?php echo ($usuario['usr_nombre']); ?></strong> -->
                    <div class="mb-1 text-white">Nombre: <?php echo ($usuario['usr_nombre']); ?></div>
                    <div class="mb-1 text-white">Apellidos: <?php echo ($usuario['usr_apellido_paterno'] . ' ' . $usuario['usr_apellido_materno']); ?></div>
                    <div class="mb-1 text-white">Celular: <?php echo ($usuario['usr_celular']); ?></div>
                    <div class="mb-1 text-white">E-mail: <?php echo ($usuario['usr_email']); ?></div>
                </div>
                <div class="my-3">
                    <a class="btn btn-success w-100 my-4 my-md-2 mx-auto" href="index.php?modulo=update-user&formTipo=dataUser" id="btn-changedata">Cambiar datos</a>
                    <a class="btn btn-success w-100 my-2 mx-auto" href="index.php?modulo=update-user&formTipo=passUser" id="btn-changedata">Cambiar contraseña</a>
                </div>

            </div>
            <div class="<?php echo ($section != '') ? 'position-absolute bottom-0' : '' ?>">
                <h6>Fecha de creacion: <span class="h6 text-danger"><?php echo ($usuario['usr_fecha_creacion']); ?></span></h6>
                <br>
                <h6>Ultima actualización: <span class="h6 text-danger"><?php echo ($usuario['usr_fecha_modificacion']); ?></span></h6>

            </div>
        </div>
        <div class="col-12 col-md-8 bg-primary bg-opacity-75 p-3">
            <div class="col-12 bg-danger p-5 my-1">
                <h3 class="text-center">Adopcion</h3>
            </div>
            <div class="col-12 bg-warning p-5 my-1">
                <h3 class="text-center">Suscripcion Padrino</h3>
            </div>
            <div class="col-12 bg-success p-5 my-1">
                <h3 class="text-center">Mis compras</h3>
                <ul class="list-group">
                    <?php foreach ($pedidos as $key => $value) : ?>
                        <li class="list-group-item"><a href="">Pedido: <?= $value['pedi_id']; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
<?php else : ?>

    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>

<?php endif; ?>