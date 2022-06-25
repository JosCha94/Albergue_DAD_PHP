<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], [2,5]);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [1]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [5]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($permisoEsp == 'true'):
        break;
    case ($rolPermitido != 'true'):
        $error = 'Su rol actual no le otorga permisos para acceder a esta página';
        break;
    case ($permisosRol != 'true'):
        $error = 'Su rol actual no tiene permiso para acceder a esta pagina';
        break;
}
?>
<?php if ($error == 'SinError') : ?>
    <?php
    require_once('BL/consultas_tienda.php');
    $consulta = new Consulta_producto();

    $pedido = $_GET['pedido'] ?? '';
    $detalle = $consulta->detalleCompra($conexion, $pedido);

    ?>


    <div class="mt-5">
        <h2 class="text-center my-2">Detalle de compra</h2>
        <div class="card-group">
            <?php foreach ($detalle as $key => $value) : ?>
                <?php $infoDeta = json_decode($value['precioCantidad']) ?>
                <div class="card" style="width: 18rem;">
                    <img width="300" height="200" src="data:image/<?php echo ($value['img_product_tipo']); ?>;base64,<?php echo base64_encode($value['img_product_foto']); ?>" alt="<?php echo ($value['product_nombre']); ?>" class="img-fluid">

                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($value['product_nombre']); ?></h5>
                        <p class="card-text fs-4">Unidades: <?php echo $infoDeta->Cantidad;  ?></p>
                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <a class=" btn btn-danger my-4" href="index.php?modulo=compras">Volver</a>
    </div>
<?php else : ?>

    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>

<?php endif; ?>