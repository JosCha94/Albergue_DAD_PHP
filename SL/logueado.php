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
}
?>