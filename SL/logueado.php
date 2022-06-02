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

    public function activeRolPermi($permisos, $id)
    {
        $perRol = $permisos;
        $array = json_decode($perRol, true);
        foreach ($array as $key => $value) :
            if ($value['id'] == $id) {
                $per = 'true';
            }
        endforeach;
        return $per;
    }

    public function permisosEspeciales($permisos, $id)
    {
        $perEsp = $permisos;
        $array = json_decode($perEsp, true);
        foreach ($array as $key => $value) :
            if ($value['id'] == $id) {
                $per = 'true';
            }
        endforeach;
        return $per;
    }
}
?>