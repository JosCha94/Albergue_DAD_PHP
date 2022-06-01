 <?php

require_once('DAL/conexion.php');
require_once('BL/consultas_adopcion.php');
$conexion = conexion::conectar();
$consulta = new Consulta_perro();
$id = $_GET['id'];
$imgPerro = $consulta ->mostarImagenes_perro($conexion,$id);
$perro = $consulta->listarPerro($conexion, $id);


 ?>
 
 <body class="body">
    <div class="container form-adopt">
        <div class="row d-flex justify-content-center align-items-center h-100" style: background-color: tanasparent:>
        <div class="col-lg-12 col-xl-11">
            <div class="card text-black" >
                <div class="card-body p-md-5">
                    <div class="row justify-content-center">
                        <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                            <p class="text-center h1 mb-5 mx-1 mx-md-4 mt-4">Formulario de adopcion</p>
                            <form class="mx-1 mx-md-4">
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="form3Example1c" class="form-control" />
                                    <label class="form-label" for="form3Example1c">Nombres</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="text" id="form3Example1c" class="form-control" />
                                    <label class="form-label" for="form3Example1c">Apellidos</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="email" id="form3Example3c" class="form-control" />
                                    <label class="form-label" for="form3Example3c">Correo electrónico</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                    <input type="tel" id="form3Example4c" class="form-control" />
                                    <label class="form-label" for="form3Example4c">Teléfono</label>
                                    </div>
                                </div>
                                <div class="d-flex flex-row align-items-center mb-4">
                                    <div class="form-outline flex-fill mb-0">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
                                    <label class="form-label" for="form3Example4cd">Explícanos, ¿Por qué quieres adoptar a <?php echo ($perro['perro_nombre']) ?>?</label>
                                    </div>
                                </div>
                                <div class="form-check d-flex justify-content-center mb-5">
                                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                                    <label class="form-check-label" for="form2Example3">
                                    Estoy de acuerdo con los <a href="#">Terminos de la adopción</a>
                                    </label>
                                </div>
                                <div class="d-grid justify-content-center btns">
                                    <a href="index.php?modulo=adoptar-formulario" class="btn btn-adopt">Enviar</a><br>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-10 col-lg-6 col-xl-7 mt-3 align-items-center order-1 order-lg-2" >
                            <div class="perro-nombre d-block mt-5">
                                <h1 class="text-center"><?php echo ($perro['perro_nombre']) ?></h1>
                            </div>
                            <div class="perro-img d-block ">
                                <img src="data:image/<?php echo ($imgPerro['img_perro_tipo']); ?>;base64,<?php echo base64_encode($imgPerro['img_perro_foto']); ?>"
                                    class="img-fluid my-5 " alt="Sample image">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
 </body>   
    