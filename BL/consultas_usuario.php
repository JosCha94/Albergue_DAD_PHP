<?php
class Consulta_usuario
{
    public function insetar_usuario($conexion, $usu)
    {
        try {
            $sql = "CALL SP_insertar_usuario(:usuario, :clave, :nombre, :ape_pat, :ape_mat, :email, :celular, @DATA)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':usuario', $usu->getUsuario());
            $consulta->bindValue(':clave', $usu->getUsr_clave());
            $consulta->bindValue(':nombre', $usu->getUsr_nombre());
            $consulta->bindValue(':ape_pat', $usu->getUsr_apellido_paterno());
            $consulta->bindValue(':ape_mat', $usu->getUsr_apellido_materno());
            $consulta->bindValue(':email', $usu->getUsr_email());
            $consulta->bindValue(':celular', $usu->getUsr_celular());


            $consulta->execute();
            $consulta->closeCursor();
            $consulta = $conexion->prepare("SELECT @DATA AS rnum");
            $consulta->execute();
            $resnum = $consulta->fetch(PDO::FETCH_ASSOC);
            return $resnum['rnum'];

        } catch (PDOException $e) {
            //  echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
                 <div class="alert alert-danger alert-dismissible fade show " role="alert">
                     <strong>Error!</strong> No se pudo insertar el usuario.
                     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             <?php        
        }
        
    }

    public function Validar_registro($usu)
    {
        $errores = [];
        $usuario = trim($usu->getUsuario());
        $clave = trim($usu->getUsr_clave());
        $nombre = trim($usu->getUsr_nombre());
        $ape_pat = trim($usu->getUsr_apellido_paterno());
        $ape_mat = trim($usu->getUsr_apellido_materno());
        $mail = trim($usu->getUsr_email());
        $celular = trim($usu->getUsr_celular());
        if (empty($usuario)) {
            $errores['usu'] = "Campo Usuario es requerido";
        } elseif (strlen($usuario) < 5 || strlen($usuario) > 15) {
            $errores['usu'] = "El campo Usuario debe tener de 5 a 15 caracteres, sin espacios en blanco";
        }
        if (empty($clave)) {
            $errores['pass'] = "El campo Contraseña es requerido";
        } elseif (strlen($clave) < 8 || strlen($clave) > 15) {
            $errores['pass'] = "La Contraseña debe tener de 8 a 15 caracteres, sin espacios en blanco";
        }
        if (empty($nombre)) {
            $errores['name'] = "El campo Nombre es requerido";
        } elseif (strlen($nombre) < 4 || strlen($nombre) > 20) {
            $errores['name'] = "El Nombre deve tener de 4 a 20 letras, sin espacios en blanco";
        } elseif (lcfirst($nombre) == ($nombre)) {
            $errores['name'] = "La primera letra del Nombre debe estar en mayuscula";
        } elseif (!preg_match("/^[A-Z][a-zñáéíóú]+$/", $nombre)) {
            if(!preg_match("/^[A-Z][a-zñáéíóú]+(\s*[A-Z][a-zñáéíóú]*)$/", $nombre)){
                $errores['name'] = "El Nombre debe tener solo letras";
            }
        }
        if (empty($ape_pat)) {
            $errores['ape_p'] = "El campo Apellido Paterno es requerido";
        } elseif (strlen($ape_pat) < 4 || strlen($ape_pat) > 20) {
            $errores['ape_p'] = "El Apellido Paterno deve tener de 4 a 20 letras, sin espacios en blanco";
        } elseif (lcfirst($ape_pat) == ($ape_pat)) {
            $errores['ape_p'] = "La primera letra del Apellido Paterno debe estar en mayuscula";
        } elseif (!preg_match("/^[A-Z][a-zñáéíóú]+$/", $ape_pat)) {
            if(!preg_match("/^[A-Z][a-zñáéíóú]+(\s*[A-Z][a-zñáéíóú]*)$/", $ape_pat)){
                $errores['ape_p'] = "El Apellido Paterno solo puede tener letras";
            }
        }
        if (empty($ape_mat)) {
            $errores['ape_m'] = "El campo Apellido Materno es requerido";
        } elseif (strlen($ape_mat) < 4 || strlen($ape_mat) > 20) {
            $errores['ape_m'] = "El Apellido Materno deve tener de 4 a 20 letras, sin espacios en blanco";
        } elseif (lcfirst($ape_mat) == ($ape_mat)) {
            $errores['ape_m'] = "La primera letra del Apellido Materno debe estar en mayuscula";
        } elseif (!preg_match("/^[A-Z][a-zñáéíóú]+$/", $ape_mat)) {
            if(!preg_match("/^[A-Z][a-zñáéíóú]+(\s*[A-Z][a-zñáéíóú]*)$/", $ape_mat)){
                $errores['ape_m'] = "El Apellido Materno solo puede tener letras";
            }
        }
        if (empty($mail)) {
            $errores['mail'] = "El campo Correo electronico es requerido";
        } elseif (strlen($mail) > 30) {
            $errores['mail'] = "El Correo electronico puede tener de hasta 30 caracteres, sin espacios en blanco";
        } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errores['mail'] = "La sintaxis del Correo electronico es incorrecta";
        }
        if (empty($celular)) {
            $errores['celu'] = "El campo Celular es requerido";
        } elseif (strlen($celular) < 9) {
            $errores['celu'] = "El Celular debe 9 digitos, sin espacios en blanco";
        } elseif (!ctype_digit($celular)) {
            $errores['celu'] = "El Celular solo puede tener numeros enteros";
        }
        return $errores;
    }

    public function detalleUsuario($conexion, $id)
    {
        try {
            $sql = "CALL SP_detalle_usuario($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetch(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema no se puede mostrar los datos del usuario por el momento
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            $user = 'error';
        }
    }

    public function actualizar_usuario($conexion, $uid, $usu)
    {
        try {
            $sql = "CALL SP_update_usuario($uid, :usuario, :nombre, :ape_pat, :ape_mat, :email, :celular,  @DATA)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':usuario', $usu->getUsuario());
            $consulta->bindValue(':nombre', $usu->getUsr_nombre());
            $consulta->bindValue(':ape_pat', $usu->getUsr_apellido_paterno());
            $consulta->bindValue(':ape_mat', $usu->getUsr_apellido_materno());
            $consulta->bindValue(':email', $usu->getUsr_email());
            $consulta->bindValue(':celular', $usu->getUsr_celular());
            
            $consulta->execute();
            $consulta->closeCursor();
            $consulta = $conexion->prepare("SELECT @DATA AS rnum");
            $consulta->execute();
            $resnum = $consulta->fetch(PDO::FETCH_ASSOC);
            return $resnum['rnum'];

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong> No se pudo actualizar el usuario.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php

        }
  
    }

    public function Validar_pass($pass1, $pass2)
    {
        $errores = [];
        $pass1 = trim($pass1);
        $pass2 = trim($pass2);
        if (empty($pass1)) {
            $errores['pass1'] = "El campo Contraseña es requerido";
        } elseif (strlen($pass1) < 8 || strlen($pass1) > 20) {
            $errores['pass1'] = "La contraseña debe tener de 8 a 20 caracteres, sin espacios en blanco";        }
        if (empty($pass2)) {
            $errores['pass2'] = "El campo Repetir Contraseña es requerido";
        } elseif ($pass1 != $pass2) {
            $errores['pass2'] = "Las contraseñas no coinciden";
        }
        return $errores;
    }
    
    public function cambiar_pass($conexion, $uid, $pass)
    {
        try {
            $sql = "CALL SP_update_clave_usuario($uid, $pass)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema , no se pudo actualizar la contraseña por el momento
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function usuario_datos_adop($conexion, $id)
    {
        try {
            $sql = "CALL SP_mostrar_datos_usuario_adop($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchall(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema no se puede mostrar los datos del usuario por el momento
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            $user = 'error';
        }
    }
    public function usuario_datos_sus($conexion, $id)
    {
        try {
            $sql = "CALL SP_mostrar_datos_usuario_sus($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $user = $consulta->fetchall(PDO::FETCH_ASSOC);
            return $user;
        } catch (PDOException $e) {
            // echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema no se puede mostrar los datos del usuario por el momento
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            $user = 'error';
        }
    }


    public function cancelar_suscipcion($conexion, $id)
    {
        try {
            $sql = "CALL SP_admin_cancelar_suscri($id)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $estado='bien';

        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <!-- <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong> Devido a un error en la base de datos, no se pudo deshabilitar el producto
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> -->

            <?php
            $estado='mal';
        }
        return $estado;
    }

    public function eliminar_cuenta($conexion, $id)
    {
        try {
            $sql = "CALL SP_eliminar_cuenta($id,  @DATA)";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $consulta->closeCursor();
            $consulta = $conexion->prepare("SELECT @DATA AS rnum");
            $consulta->execute();
            $resnum = $consulta->fetch(PDO::FETCH_ASSOC);
            $estado = $resnum['rnum'];

        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
              <!-- <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Error!</strong> Devido a un error en la base de datos, no se pudo deshabilitar el producto
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> -->

            <?php
            $estado='mal';
        }
        return $estado;
    }


    
}
?>