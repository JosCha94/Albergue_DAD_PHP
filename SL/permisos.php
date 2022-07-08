<?php
class autorizacion
{
    public function logueado($mysesion)
    {
        if ($mysesion == null || $mysesion == '') {
            $log = 'false';
        } else {
            $log = 'true';
        }
        return $log;
    }

    public function activeRol($estado, $id)
    {
        $res='';
        $Rol = $estado;
        $array = json_decode($Rol, true);
        foreach ($array as $key => $value) :
            if (in_array($value['id'] , $id)) {
                $res = 'true';
            }
        endforeach;
        return $res;
    }

    public function activeRolPermi($permisos, $id)
    {
        $perRol = $permisos;
        $array = json_decode($perRol, true);
        foreach ($array as $key => $value) :
            if (in_array($value['id'] , $id)) {
                $per = 'true';
            }
        endforeach;
        return $per;
    }

    public function permisosEspeciales($permisos, $id)
    {
        $per='';
        $perEsp = $permisos;
        $array = json_decode($perEsp, true);
        foreach ($array as $key => $value) :
            if (in_array($value['id'] , $id)) {
                $per = 'true';
            }
        endforeach;
        return $per;
    }

    public function permisos($conexion)
    {
        try {
            $sql = "CALL SP_select_Permisos_Activos()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $per = $consulta->fetchAll(PDO::FETCH_ASSOC);
            // foreach ($permit as $key => $value) :
            //     if (in_array($value['permiso_id'] , $id_per)) {
            //         $per = 'true';
            //     }
            // endforeach;
            return $per;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
            ?>
            <!-- <div class="alert alert-danger alert-dismissible fade show " role="alert">
              <strong>Error!</strong> Debido a un problema no se pudo cargar los permisos por el momento
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div> -->
            <?php

        }

    }
}
?>