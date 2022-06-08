<?php
$permisosRol = $log->activeRolPermi($_SESSION['usuario'][3], [1]);
$permisoEsp = $log->permisosEspeciales($_SESSION['usuario'][4], [1]);

switch ($error = 'SinError') {
    case ($logueado == 'false'):
        $error = 'Debe iniciar sesión para poder visualizar este pagina';
        break;
    case ($permisoEsp == 'true'):
        break;
    case ($rol != 'true'):
        $error = 'No tiene activado el rol de Cliente';
        break;
    case ($permisosRol != 'true'):
        $error = 'Su rol actual no tiene permiso para acceder a esta pagina';
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

    <body class="body">
        <div class="container form-adopt">
            <div class="row d-flex justify-content-center align-items-center h-100" style: background-color: tanasparent:>
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 mb-5 mx-1 mx-md-4 mt-4">Formulario de adopcion</p>
                                    <form action="" method="post" class="mx-1 mx-md-4">
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
                                <div class="col-md-10 col-lg-6 col-xl-7 mt-3 align-items-center order-1 order-lg-2">
                                    <div class="perro-nombre d-block mt-5">
                                        <h1 class="text-center"><?php echo ($perro['perro_nombre']) ?></h1>
                                    </div>
                                    <div class="perro-img d-block ">
                                        <img src="data:image/<?php echo ($imgPerro['img_perro_tipo']); ?>;base64,<?php echo base64_encode($imgPerro['img_perro_foto']); ?>" class="img-fluid my-5 " alt="Sample image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<?php else : ?>

    <div class="alert alert-danger" role="alert">
        <?php echo $error; ?>
    </div>

<?php endif; ?>