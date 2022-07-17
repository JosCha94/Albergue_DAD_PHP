<?php
switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($rolActual == ' '):
        $error = 'No tiene un rol activado';
        break;
}
?>
<?php if ($error == 'SinError') : ?>
    <?php
    require_once('BL/consultas_usuario.php');
    require_once('BL/consultas_compras.php');
    require_once 'ENTIDADES/usuario.php';
    require_once('DAL/conexion.php');
    $conexion = conexion::conectar();
    $consulta = new Consulta_usuario();
    $consulta2 = new Consulta_compra();
    $id = $_SESSION['usuario'][0];
    $usuario = $consulta->detalleUsuario($conexion, $id);
    $pedidos = $consulta2->listar_pedidos_user($conexion, $id);
    $adop_datos = $consulta->usuario_datos_adop($conexion, $id);
    $sus_datos = $consulta->usuario_datos_sus($conexion, $id);



    if (isset($_POST['usr-cancel-sus'])) {
        $sus_id = $_POST['cancel-sus'];

        $cancel = $consulta->cancelar_suscipcion($conexion, $sus_id);
        if (!$cancel) {
            echo '<div class="alert alert-danger">¡Ocurrio un error, la solicitud no pudo ser rechazada!.</div>';
        } else {
            echo "<meta http-equiv='refresh' content='2'>";
            echo '<div class="alert alert-success">¡La suscripcion fue cancelada exitosamente!.</div>';
        }
    }

    if (isset($_POST['btn-delCuenta'])) {
        $userId = $id;

        $elimina = $consulta->eliminar_cuenta($conexion, $userId);
        if ($elimina == 1) {
            echo '<div class="alert alert-danger alert-dismissible fade show " role="alert">
            <strong>Error!</strong> No se pudo cerrar su cuenta ahora, intentelo mas tarde
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        } elseif ($elimina == 2) {
            echo '<div class="alert alert-success alert-dismissible fade show " role="alert">
             Tienes una adopcion vigente y no puedes cerrar tu cuenta hasta que no finalice.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        } elseif ($elimina == 3) {
            echo '<div class="alert alert-success alert-dismissible fade show " role="alert">
         Tienes una solicitud de adopcion en proceso, podras cerrar tu cuenta cuando concluya.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        } elseif ($elimina == 4) {
            echo '<div class="alert alert-success alert-dismissible fade show " role="alert">
     Tienes pedidos sin recoger, recogelos para poder cerrar tu cuenta
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        } elseif ($elimina == 5) {
            session_destroy();
            echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=inicio&cerrarcuenta=Su cuenta se cerro exitosamente" />';
        }
    }
    ?>

    <h1 class="text-center text-uppercase my-4">HOLA <?php echo ($usuario['usuario']); ?></h1>
    <div class="row my-md-4 shadow-lg">
        <div class="col-12 col-md-4  p-3 position-relative user-data">
            <h3 class="text-center h1"> Mis Datos</h3>
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col p-4 mt-2 d-flex flex-column position-static">
                    <!-- <strong class="d-inline-block mb-2 text-white">Nombre: <?php echo ($usuario['usr_nombre']); ?></strong> -->
                    <div class="mb-1 u-data">Nombre: <?php echo ($usuario['usr_nombre']); ?></div>
                    <div class="mb-1 u-data">Apellidos: <?php echo ($usuario['usr_apellido_paterno'] . ' ' . $usuario['usr_apellido_materno']); ?></div>
                    <div class="mb-1 u-data">Celular: <?php echo ($usuario['usr_celular']); ?></div>
                    <div class="mb-1 u-data">E-mail: <?php echo ($usuario['usr_email']); ?></div>
                </div>
                <div class="my-3">
                    <a class="btn btn-adopt w-100 my-4 my-md-2 mx-auto" href="index.php?modulo=update-user&formTipo=dataUser" id="btn-changedata">Cambiar datos</a>
                    <a class="btn btn-adopt w-100 my-2 mx-auto" href="index.php?modulo=update-user&formTipo=passUser" id="btn-changedata">Cambiar contraseña</a>
                    <form method="post" action="">
                        <!-- <input type="hidden" name="cancelU-id" value="<?php echo ($usuario['usr_id']); ?>"> -->
                        <button class="btn btn-danger w-100 my-2 mx-auto" onclick="return confirm('¿Quieres cerrar tu cuenta de forma definitiva? , todas tus suscripciones se cancelaran aunq no hayan finalizado')" name="btn-delCuenta">Cerrar cuenta</a>
                    </form>

        </div>
        <div class="<?php echo ($section != '') ? 'position-absolute bottom-0' : '' ?>">
                <h6 class="user-date">Fecha de creacion: <span class="h6"><?php echo ($usuario['usr_fecha_creacion']); ?></span></h6>
                <br>
                <h6 class="user-date">Ultima actualización: <span class="h6"><?php echo ($usuario['usr_fecha_modificacion']); ?></span></h6>

            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 p-3 user-adopt">
        <div class="accordion" id="accordionPanelsStayOpenExample">
            <div class="accordion-item one">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Mis Perritos adoptados
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <?php if (count($adop_datos) >0): ?>
                    <?php foreach ($adop_datos as $key => $value) : ?>
                    <div class="accordion-body">
                        <ul class="borde p-3">
                            <li class="mx-5 mt-2">Nombre del perrito :<strong><?= $value['perro_nombre']?></strong></li>
                            <li class="mx-5">Fecha de entrevista :<strong><?= $value['adop_fecha_entrevista']?></strong></li>
                            <li class="mx-5">Estado de la adopción :<strong><?php if($value['adop_estado'] == 'Rechazada'){ echo 'Lo sentimos, su solicitud fue rechazada o el perrito fue adoptado por otra persona';}else{echo $value['adop_estado'];} ?></strong></li>
                            <li class="mx-5 mb-2">fecha de adopción :<strong><?= $value['adop_fecha']?></strong></li>
                        </ul>
                    </div>
                    <?php endforeach;?>
                    <?php elseif(count($adop_datos) == 0): ?>
                    <div class="empty-msg">
                        Este apartado está vacio
                    </div>
                    <?php endif; ?>    
                </div>
            </div>

        <div class="col-12 col-md-8 p-3 user-adopt">
            <div class="accordion" id="accordionPanelsStayOpenExample">
                <div class="accordion-item one">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            Mis Perritos adoptados
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <?php if (count($adop_datos) > 0) : ?>
                            <?php foreach ($adop_datos as $key => $value) : ?>
                                <div class="accordion-body">
                                    <ul class="borde p-3">
                                        <li class="mx-5 mt-2">Nombre del perrito :<strong><?= $value['perro_nombre'] ?></strong></li>
                                        <li class="mx-5">Fecha de entrevista :<strong><?= $value['adop_fecha_entrevista'] ?></strong></li>
                                        <li class="mx-5">Estado de la adopción :<strong><?= $value['adop_estado'] ?></strong></li>
                                        <li class="mx-5 mb-2">fecha de adopción :<strong><?= $value['adop_fecha'] ?></strong></li>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <div class="empty-msg">
                                Este apartado está vacio
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="accordion-item two">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            Mis suscripciones
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                        <?php if (count($sus_datos) > 0) : ?>
                            <?php foreach ($sus_datos as $key => $value) : ?>
                                <div class="accordion-body">
                                    <div class="row borde">
                                        <div class="col-md-6">
                                            <ul class="p-3">
                                                <li class="mx-5 mt-2">Tipo de suscripción : <strong><?= $value['s_tipo_nombre'] ?></strong></li>
                                                <li class="mx-5">Precio :<strong><?= $value['s_tipo_precio'] ?></strong></li>
                                                <?php if ($value['suscrip_estado'] == 'Cancelada') : ?>
                                                    <li class="mx-5 ">Estado de la suscripción: <strong class="text-danger"><?= $value['suscrip_estado'] ?></strong></li>
                                                <?php else : ?>
                                                    <li class="mx-5 ">Estado de la suscripción: <strong class="text-success"><?= $value['suscrip_estado'] ?></strong></li>
                                                <?php endif; ?>
                                                <li class="mx-5">Fecha de Inicio :<strong><?= $value['suscrip_fecha_inicio'] ?></strong></li>
                                                <li class="mx-5 mb-2">Fecha de caducidad : <strong><?= $value['suscrip_fecha_termino']; ?></strong></li>
                                            </ul>
                                        </div>
                                        <?php if ($value['suscrip_estado'] == 'Cancelada') : ?>
                                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                                <a href="index.php?modulo=apadrinar" class="btn text-white usr-cancel-sus btn-success p-3 mb-3" name="usr-cancel-sus">¡Suscribete denuevo!</a>
                                            </div>
                                        <?php else : ?>
                                            <div class="col-md-6 d-flex align-items-center justify-content-center">
                                                <form action="" method="POST">
                                                    <button class="btn usr-cancel-sus btn-warning p-3 mb-3" name="usr-cancel-sus" onclick="return checkDelete()">Cancelar suscripción</button>
                                                    <input type="hidden" name="cancel-sus" value="<?= $value['suscrip_id']; ?>">
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                        </row>
                                    </div>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="empty-msg m-3">
                                    No tienes suscripciones activas en este momento
                                </div>
                            <?php endif; ?>
                                </div>
                    </div>
                </div>
                <div class="accordion-item three">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            Mis compras
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse <?php echo (count($pedidos) > 0) ? 'show' : '' ?>" aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            <?php if (count($pedidos) > 0) : ?>
                                <?php foreach ($pedidos as $key => $value) : ?>
                                    <form action="index.php?modulo=voucher" method="post">
                                        <input type="hidden" name="idPedido" value="<?= $value['pedi_id']; ?>">
                                        <button name="verVoucher" class="btn btn-light w-100 d-flex justify-content-between my-2">
                                            <h5>Pedido: <?= $value['pedi_id']; ?></h5> <span class="h5 <?php echo ($value['pedi_estado'] == 'Recogido') ? 'text-success' : 'text-danger' ?>"><?= $value['pedi_estado']; ?></span>
                                        </button>
                                    </form>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <div class="empty-msg">
                                    No tiene compras realizadas en los ultimos 30 dias
                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>

    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>

<?php endif; ?>