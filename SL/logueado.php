<?php
class autorizacion{
public function logueado($mysesion){
    if ($mysesion == null || $mysesion == ''){
        $log ='false';
    }
    else{
        $log ='true';
    }
    return $log;
 }
}
?>