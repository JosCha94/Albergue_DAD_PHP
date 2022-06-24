<?php
require_once('BL/consultas_pedido.php');
require_once 'ENTIDADES/usuario.php';
$consulta = new Consulta_pedido();
$idPedido = $_POST['idPedido'];
$pedido = $consulta->select_pedido($conexion, $idPedido);
$detallePedido = $consulta->select_detallePedido_id($conexion, $idPedido);
$infoCli = json_decode($pedido['datos_cliente']);

?>

<div class="mt-5">
    <div class="card">
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-12 col-md-6 mx-auto">
                    <div class="text-center mt-2">
                        <img src="Presentacion/libs/images/doglogo.png" alt="logo" width="80em" class="ms-auto">
                    </div>
                    <div class="mt-2">
                        <div class="text-center centrado">
                            <h5 class="h3 my-3 fw-normal text-center">PlanetDog SAC</h5>
                            <p class="card-text">NOMBRE COMERCIAL</p>
                            <p class="card-text">Correo electrónico: planetdog@gmail.com</p>
                            <p class="card-text">Telefono: 054 - 123456</p>
                        </div>
                    </div>

                    <!-- <h5 class="card-title">Card title</h5> -->
                </div>
                <div class="col-12 col-md-6 mx-auto">
                    <div class="text-center mt-2 border rounded-2">
                        <p class="card-text fs-6">RUC: 123456</p>
                        <p class="card-text fs-5 "><?php echo $pedido['tipo_comprobante']; ?></p>
                        <p class="card-text fs-6"><?php echo $pedido['serie_comprobante']; ?></p>
                    </div>
                    <!-- <h5 class="card-title">Card title</h5> -->
                    <div class="text-center mt-2 border rounded-2 p-1">
                        <p class="card-text">Fecha de Emision: <?php echo $pedido['pedi_fecha']; ?></p>
                        <p class="card-text-md ">Cliente: <?php echo $infoCli->cliente;  ?></p>
                        <p class="card-text">DNI: <?php echo $infoCli->dni;  ?></p>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12 border border-2 rounded-3">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Producto</th>
                                <th scope="col">P.U.</th>
                                <th scope="col">SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detallePedido as $key => $value) : ?>
                                <?php $infoDeta = json_decode($value['precioCantidad']) ?>
                                <tr>
                                    <td><?php echo $infoDeta->Cantidad;  ?></td>
                                    <td><?php echo $value['product_nombre']; ?></td>
                                    <td><?php echo $infoDeta->Precio;  ?></td>
                                    <td><?php echo $infoDeta->Precio_Total;  ?></td>
                                </tr>
                                <?php $Subtotal = $Subtotal + $infoDeta->Precio_Total ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="col-4 offset-md-10">
                        <p class="card-text">SUBTOTAL: <?php echo $Subtotal;  ?></p>
                        <p class="card-text">IGV: <?php echo $pedido['pedi_igv']; ?></p>
                        <p class="card-text">TOTAL: <?php echo $pedido['pedi_monto']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>