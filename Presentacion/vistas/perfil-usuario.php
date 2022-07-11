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
            </div>
        </div>
        <div class="<?php echo ($section != '') ? 'position-absolute bottom-0' : '' ?>">
            <h6 class="user-date">Fecha de creacion: <span class="h6"><?php echo ($usuario['usr_fecha_creacion']); ?></span></h6>
            <br>
            <h6 class="user-date">Ultima actualización: <span class="h6"><?php echo ($usuario['usr_fecha_modificacion']); ?></span></h6>

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
                    
                    <?php
                    if (count($adop_datos) >0){
                        foreach ($adop_datos as $key => $value) : ?>
                            <div class="accordion-body">
                                <ul class="borde p-3">
                                    <li class="mx-5 mt-2">Nombre del perrito :<strong><?= $value['perro_nombre']?></strong></li>
                                    <li class="mx-5">Fecha de entrevista :<strong><?= $value['adop_fecha_entrevista']?></strong></li>
                                    <li class="mx-5">Estado de la adopción :<strong><?= $value['adop_estado']?></strong></li>
                                    <li class="mx-5 mb-2">fecha de adopción :<strong><?= $value['adop_fecha']?></strong></li>
                                </ul>
                            </div>
                    <?php endforeach;
                    }else{ ?>
                        <div class="empty-msg">
                            Este apartado está vacio
                        </div>
                        <?php
                    }
                    ?>
                    

                </div>
            </div>
            <div class="accordion-item two">
                <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Mis suscripciones
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <?php 
                    if (count($adop_datos) >0){
                    foreach ($sus_datos as $key => $value) : ?>
                    <div class="accordion-body">
                        <ul class="borde p-3">
                            <li class="mx-5 mt-2">Tipo de suscripción : <strong><?= $value['s_tipo_nombre']?></strong></li>
                            <li class="mx-5">Precio :<strong><?= $value['s_tipo_precio']?></strong></li>
                            <li class="mx-5">Estado de la suscripción<strong><?= $value['suscrip_estado']?></strong></li>
                            <li class="mx-5">Fecha de Inicio :<strong><?= $value['suscrip_fecha_inicio']?></strong></li>
                            <li class="mx-5 mb-2">Fecha de caducidad : <strong><?= $value['suscrip_fecha_termino'];?></strong></li>
                        </ul>
                    </div>
                    <?php endforeach; ?>
                }else{ ?>
                        <div class="empty-msg">
                            Este apartado está vacio
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
            <div class="accordion-item three">
                <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                        Mis compras
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse <?php echo(count($pedidos)>0)?'show':'' ?>" aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                    <?php if(count($pedidos)>0) : ?>
                    <?php foreach ($pedidos as $key => $value) : ?>
                        <form action="index.php?modulo=voucher" method="post">
                            <input type="hidden" name="idPedido" value="<?= $value['pedi_id']; ?>">
                            <button name="verVoucher" class="btn btn-light w-100 d-flex justify-content-between my-2">
                                <h5>Pedido: <?= $value['pedi_id']; ?></h5> <span class="h5 <?php echo($value['pedi_estado'] == 'Recogido') ? 'text-success': 'text-danger' ?>"><?= $value['pedi_estado']; ?></span>
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