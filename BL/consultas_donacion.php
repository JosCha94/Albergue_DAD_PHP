<?php
class Consulta_donacion
{
    public function insertarDonacion($conexion,$don)
    {
        try {
            $sql = "CALL SP_insertar_donacion(:nombres, :apellidos, :correo, :celular, :vaucher, :nombre_img :tipo_img)";
            $consulta = $conexion->prepare($sql);
            $consulta->bindValue(':nombres', $don->getDona_nombres());
            $consulta->bindValue(':apellidos', $don->getDona_apellidos());
            $consulta->bindValue(':correo', $don->getDona_correo());
            $consulta->bindValue(':celular', $don->getDona_celular());
            $consulta->bindValue(':vaucher', $don->getDona_vaucher());
            $consulta->bindValue(':nombre_img', $don->getDona_nombre_img());
            $consulta->bindValue(':tipo_img', $don->getDona_tipo_img());
            $consulta->execute();
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }
    
    public function validar_donacion($don)
    {
        $errores = [];
        $nombres = trim ($don->getDona_nombres());
        $apellidos = trim ($don->getDona_apellidos());
        $correo = trim ($don->getDona_correo());
        $celular = trim ($don->getDona_celular());
        $vaucher = $don->getDona_vaucher();
        $nombre_img = trim ($don->getDona_nombre_img());
        $tipo_img = trim ($don->getDona_tipo_img());

        if (empty($nombres)) {
            $errores['nombres'] = 'El nombre es obligatorio';
        }elseif (strlen($nombres) < 3) {
            $errores['nombres'] = 'El nombre debe tener al menos 3 caracteres';
        }

        if (empty($apellidos)) {
            $errores['apellidos'] = 'El apellido es obligatorio';
        }elseif (strlen($apellidos) < 3) {
            $errores['apellidos'] = 'El apellido debe tener al menos 3 caracteres';
        }

        if (empty($correo)) {
            $errores['correo'] = 'El correo es obligatorio';
        }elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $errores['correo'] = 'El correo no es válido';
        }

        if (empty($celular)) {
            $errores['celular'] = 'El celular es obligatorio';
        }elseif (strlen($celular) < 9) {
            $errores['celular'] = 'El celular debe tener al menos 9 caracteres';
        } elseif (!ctype_digit($celular)) {
            $errores['celular'] = 'El celular debe ser numérico';
        } 

        if (empty($vaucher)) {
            $errores['vaucher'] = 'El vaucher es obligatorio';
        } 

        if (empty($tipo_img)) {
            $errores['tipo_img'] = 'El tipo de imagen es obligatorio';
        }  elseif ($tipo_img != 'jpg' && $tipo_img != 'png' && $tipo_img != 'jpeg') {
            $errores['tipo_img'] = 'El tipo de imagen debe ser jpg, jpeg o png';
        }

        if  ($_FILES['vaucher']['size'] > 3000000) {
            $errores['vaucher'] = 'El tamaño de la imagen no debe superar los 3MB';
        }  
         
        return $errores;
    }

    
}
?>
