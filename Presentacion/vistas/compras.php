<?php
$rolPermitido= $log->activeRol($_SESSION['usuario'][2], [2,3]);
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [5]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [5]);
$Permiso2 = $log->activeRolPermi($_SESSION['usuario'][3], [6]);
$Permiso = $log->permisosEspeciales($_SESSION['usuario'][3], [6]);

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
require_once('BL/consultas_compras.php');
$consulta = new Consulta_compra();
$ventas = $consulta->listarVentasSinRecoger($conexion);

if (isset($_POST['cambiarEstadoPedido'])) {
    $pedidoId = $_POST['pedido_id'];

    $estado = $consulta->pedido_recogido($conexion, $pedidoId);

    if ($estado == 'mal') {
    } else {
        echo '<meta http-equiv="refresh" content="0; url=index.php?modulo=compras&mensaje=El estado del pedido cambio" />';
    }
}

?>
<h2 class="text-center mt-3 h1">Compras sin recoger</h2>

<hr>
<div class="row">
    <div class="col-sm-12">
        <div class="my-3 ">
            <table class="table table-sm table-hover" id="tablaVentasSin">
                <thead class="bg-danger text-white">
                    <tr>
                        <td>Numero de comprobante </td>
                        <td>Tipo de comprobante </td>
                        <td>Datos del cliente </td>
                        <td>Serie del comprobante </td>
                        <td>Fecha</td>
                        <td>Precio total </td>
                        <td>Estado</td>
                        <?php if ($Permiso == 'true' || $Permiso2 == 'true'):?>               
                        <td>Recogido</td>
                        <?php endif; ?>

                    </tr>
                </thead>
                <tfoot class="bg-secondary text-white">
                    <tr>
                        <td>Numero de comprobante </td>
                        <td>Tipo de comprobante </td>
                        <td>Datos del cliente </td>
                        <td>Serie del comprobante </td>
                        <td>Fecha</td>
                        <td>Precio total </td>
                        <td>Estado</td>
                        <?php if ($Permiso == 'true' || $Permiso2 == 'true'):?>               
                        <td>Recogido</td>
                        <?php endif; ?>

                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach ($ventas as $key => $value) : ?>
                        <tr class="text-center">
                            <td><?php echo ($value['pedi_id']); ?>
                            <br><a href="index.php?modulo=detalle_compra&pedido=<?php echo ($value['pedi_id']); ?>">Detalle</a> </td>
                            <td><?php echo ($value['tipo_comprobante']); ?> </td>
                            <td><?php echo ($value['datos_cliente']); ?></td>
                            <td><?php echo ($value['serie_comprobante']); ?> </td>
                            <td><?php echo ($value['pedi_fecha']); ?> </td>
                            <td><?php echo ($value['pedi_monto']); ?> </td>
                            <td><?php echo ($value['pedi_estado']); ?> </td>
                            <?php if ($Permiso == 'true' || $Permiso2 == 'true'):?>     
                            <td>
                                <form action="" method="post">
                                    <input type="hidden" name="pedido_id" value="<?= $value['pedi_id']; ?>">
                                    <button class="btn btn-success btn-xs mt-4 cambiarEstadoPedido" onclick="return confirm('¿Quieres cambiar estado de pedido a recogido?')" name="cambiarEstadoPedido" title="Cambiar estado"><i class="fa-solid fa-check"></i></button>
                                </form>
                            </td>
                            <?php endif; ?>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>
<?php else : ?>

<div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
</div>

<?php endif; ?>