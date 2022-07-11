<?php
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [1]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [1]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($permisoEsp == 'true'):
        break;
    case ($rolActi != 'true'):
        $error = 'No tiene activado el rol de Cliente';
        break;
}
?>
<?php if ($error == 'SinError') : ?>
    <?php
    require_once('ENTIDADES/adopciones.php');
    require_once('DAL/conexion.php');
    require_once('BL/consultas_adopcion.php');

    $conexion = conexion::conectar();
    $consulta = new Consulta_adopcion();
    $id = $_GET['id'];
    $usrId = $_SESSION['usuario'][0];
    $imgPerro = $consulta->mostarImagenes_perro($conexion, $id); //muestra la imagen del perro seleccionado
    $perro = $consulta->listarPerro($conexion, $id); //muestra los datos del perro seleccionado
    $usr_ado = $consulta->mostrarUsuario_adopcion($conexion, $usrId); //select de los datos necesarios para llenar los campos del formulario


    if (isset($_POST['adopt_submit'])) {
        $uId = $_POST['usrId'];
        $rolId = $_POST['rolId'];
        $perro_id = $_POST['perroId'];
        $dueno = $_POST['dueno'];
        $razon = $_POST['tex_adop'];
        $adop = new adopcion($uId, $rolId, $perro_id, $dueno, $razon);
        $consulta = new Consulta_adopcion();
        $estado = $consulta->insertarForm_adopcion($conexion, $adop);
        if ($estado == 'mal') {
        } else {
            echo '<div class="alert alert-success">Solicitud de enviada con exito. Ahora, por favor espere un maximo de 48 horas para una respuesta.</div>';
        }
    }

    ?>

    <div class="container form-adopt">
        <div class="card text-black">
            <div class="card-body d-flex  ">
                <div class="row justify-content-center">
                    <div class="col-md-7 ">
                        <p class="text-center f mb-5 mx-1 mx-md-4 mt-4">Formulario de adopcion</p>
                        <form action="" method="post" class="mx-1 mx-md-4 bg-secondary bg-opacity-75 p-5 shadow-lg">
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="nom_adop" class="form-control" name="nom_adop" value="<?= $usr_ado['usr_nombre'] ?>" disabled>
                                    <label class="form-label" for="nom_adop">Nombres</label>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="ape_adop" class="form-control" name="ape_adop" value="<?= $usr_ado['usr_apellido_paterno'] ?> <?= $usr_ado['usr_apellido_materno'] ?> " disabled>
                                    <label class="form-label" for="ape_adop">Apellidos</label>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <input type="email" id="corr_adop" class="form-control" name="corr_adop" value="<?= $usr_ado['usr_email'] ?>" disabled>
                                    <label class="form-label" for="corr_adop">Correo electrónico</label>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <input type="tel" id="tel_adop" class="form-control" name="tel_adop" value="<?= $usr_ado['usr_celular'] ?>" disabled>
                                    <label class="form-label" for="tel_adop">Teléfono</label>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <div class="form-outline flex-fill mb-0">
                                    <textarea class="form-control" id="tex_adop" rows="5" name="tex_adop" placeholder="Por favor, sea especifico..." required></textarea>
                                    <label class="form-label" for="tex_adop">Explícanos, ¿Por qué quieres adoptar a <?php echo ($perro['perro_nombre']) ?>?</label>
                                </div>
                            </div>
                            <div class="form-check d-flex justify-content-center mb-5">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" required />
                                <label class="form-check-label" for="form2Example3">
                                    Estoy de acuerdo con los <a href="#">Terminos de la adopción</a>
                                </label>
                            </div>
                            <div class="d-grid btns">
                                <button type="submit" class="btn btn-adopt" name="adopt_submit">Enviar</button>
                            </div>
                            <input type="hidden" name="dueno" value="<?= $usr_ado['usr_nombre'] ?> <?= $usr_ado['usr_apellido_paterno'] ?> <?= $usr_ado['usr_apellido_materno'] ?> ">
                            <input type="hidden" name="usrId" value="<?php echo $_SESSION['usuario'][0]; ?>">
                            <input type="hidden" name="rolId" value="<?= $usr_ado['rol_id'] ?>">
                            <input type="hidden" name="perroId" value="<?php echo $_GET['id'] ?>">

                        </form>
                    </div>
                    <div class="col-md-5">
                        <div class="perro-nombre d-block mt-5">
                            <p class="text-center f"><?php echo ($perro['perro_nombre']) ?></p>
                        </div>
                        <div class="perro-img mt-5 ">
                            <img src="data:image/<?php echo ($imgPerro['img_perro_tipo']); ?>;base64,<?php echo base64_encode($imgPerro['img_perro_foto']); ?>" class="img-fluid shadow-lg" alt="Sample image">
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