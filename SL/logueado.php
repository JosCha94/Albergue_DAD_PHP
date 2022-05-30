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

    public function activeRol($estado)
    {
        if ($estado == 'Activado') {
            $res = 'true';
        } else {
            $res = 'false';
        }
        return $res;
    }

    public function activePermi($estado)
    {
        if ($estado == 'Activado') {
            $per = 'true';
        } else {
            $per = 'false';
        }
        return $per;
    }

    public function permisosActivos($conexion)
    {
        try{
            $sql = "CALL SP_select_permisos_activos()";
            $consulta = $conexion->prepare($sql);
            $consulta->execute();
            $permisos = $consulta->fetchAll(PDO::FETCH_ASSOC);
            return $permisos;
        } catch (PDOException $e) {
            echo "Ocurrió un ERROR con la base de datos: " .    $e->getMessage();
        }
    }
}
?>