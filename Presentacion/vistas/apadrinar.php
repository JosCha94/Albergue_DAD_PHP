<?php
require_once('DAL/conexion.php');
require_once('BL/consultas_apadrinar.php');
$conexion = conexion::conectar();
$consulta = new Consulta_apadrinar();

$susTipo = $consulta -> listarTipoSuscrip($conexion);

if (in_array(2,$PermisosVistaPag)):
?>

<div class="container-fluid py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="sus-title ps-5 mb-5" style="max-width: 600px;">
                    <h6 class=" text-uppercase">Planes de suscripción</h6>
                    <h1 class="display-5 text-uppercase mb-0">apadrina y apoya a los perritos del albergue</h1>
                </div>
                <div class="sus-p text-center">
                    <p class="h4"><i> <strong>Apadrinar</strong>  a nuestros perritos nunca fue tan fácil, con planes desde los <strong>S/9.00</strong></i> </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="d-flex justify-content-center">
                    <img  class="img-fluid w-50" src="Presentacion/libs/images/sus-perro2.png" alt="">
                </div>
            </div>
        </div>
        <div class="row g-5">
            <div class="sus-lado col-lg-4">
                <div class="text-center pt-5 mt-lg-5">
                    <h2 class="text-uppercase"><?=$susTipo[0]['s_tipo_nombre']; ?></h2>
                    <h6 class="text-body mb-5">El plan más económico</h6>
                    <div class="text-center precio p-4 mb-2">
                        <h1 class="display-4 text-white mb-0">
                            <small class="align-top"
                                style="font-size: 22px; line-height: 45px;">S/</small><?=$susTipo[0]['s_tipo_precio']; ?><small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/
                                Mes</small>
                        </h1>
                    </div>
                    <div class="p-4">
                        <h4 class="text-center mb-4">Tu ayuda nos servirá para:</h4>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Comida para nuestros perritos</li>
                        </div>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Limpieza del albergue</li>
                        </div>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Cuidado de los perritos</li>
                        </div>
                        <form action="index.php?modulo=apadrinar-detalles" method="post">
                            <input type="hidden" name="susId" value="<?= $susTipo[0]['s_tipo_id']; ?>">
                            <button class="btn btn-adopt text-uppercase py-2 px-4 my-5">Suscribirme</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="sus-centro col-lg-4">
                <div class="text-center pt-5">
                    <h2 class="text-uppercase"><?=$susTipo[1]['s_tipo_nombre']; ?></h2>
                    <h6 class="text-body mb-5">Plan intermedio</h6>
                    <div class="text-center precio p-4 mb-2">
                        <h1 class="display-4  text-white mb-0">
                            <small class="align-top"
                                style="font-size: 22px; line-height: 45px;">S/</small><?=$susTipo[1]['s_tipo_precio']; ?><small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/
                                Mes</small>
                        </h1>
                    </div>
                    <div class="p-4">
                        <h4 class="text-center mb-4">Tu ayuda nos servirá para:</h4>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Comida para nuestros perritos</li>
                        </div>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Limpieza del albergue</li>
                        </div>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Cuidado de los perritos</li>
                        </div>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Apoyo para nuestro voluntarios</li>
                        </div>
                        <form action="index.php?modulo=apadrinar-detalles" method="post">
                            <input type="hidden" name="susId" value="<?= $susTipo[1]['s_tipo_id']; ?>">
                            <button class="btn btn-adopt text-uppercase py-2 px-4 my-5">Suscribirme</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="sus-lado col-lg-4">
                <div class="text-center pt-5 mt-lg-5">
                    <h2 class="text-uppercase"><?=$susTipo[2]['s_tipo_nombre']; ?></h2>
                    <h6 class="text-body mb-5">¡La mejor opcion!</h6>
                    <div class="text-center precio p-4 mb-2">
                        <h1 class="display-4 text-white mb-0">
                            <small class="align-top"
                                style="font-size: 22px; line-height: 45px;">S/</small><?=$susTipo[2]['s_tipo_precio']; ?><small
                                class="align-bottom" style="font-size: 16px; line-height: 40px;">/
                                Mes</small>
                        </h1>
                    </div>
                    <div class="p-4 ">
                        <h4 class="text-center mb-4">Tu ayuda nos servirá para:</h4>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Comida para nuestros perritos</li>
                        </div>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Limpieza del albergue</li>
                        </div>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Cuidado de los perritos</li>
                        </div>
                        <div class="d-flex justify-content-start mb-1">
                            <li>Apoyo para nuestros voluntarios</li>
                        </div>
                        <div class=" d-flex justify-content-startmb-1">
                            <li>Campañas de salud y adopcion</li>
                        </div>
                        <form action="index.php?modulo=apadrinar-detalles" method="post">
                            <input type="hidden" name="susId" value="<?= $susTipo[2]['s_tipo_id']; ?>">
                            <button class="btn btn-adopt text-uppercase py-2 px-4 my-5">Suscribirme</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
<!-- <div class="container"> -->
    <div class="row">
        
        <img src="Presentacion\libs\images\mantenimiento-web.png" alt="pagina en mantenimiento" class="img-fluid mt-5 mx-auto">
        </div>
    <!-- </div> -->
    
<?php endif; ?>
