<?php

class adopcion{
    private $usr_id;
    private $rol_id;
    private $perro_id;
    private $adop_dueño;
    private $adop_razon;
    private $adop_observaciones;
    private $adop_fecha;
    private $adop_ultima_visita;
    private $adop_resumen_visitas;

    public function __construct($adop_dueño, $adop_razon, $adop_observaciones, $adop_fecha, $adop_ultima_visita, $adop_resumen_visitas){
        $this->usr_id = $usr_id;
        $this->rol_id = $rol_id;
        $this->perro_id = $perro_id;
        $this->adop_dueño = $adop_dueño;
        $this->adop_razon = $adop_razon;
        $this->adop_observaciones = $adop_observaciones;
        $this->adop_fecha = $adop_fecha;
        $this->adop_ultima_visita = $adop_ultima_visita;
        $this->adop_resumen_visitas = $adop_resumen_visitas;
    }

    public function getUsr_id(){
        return $this->usr_id;
    }
    public function getRol_id(){
        return $this->rol_id;
    }
    public function getPerro_id(){
        return $this->perro_id;
    }
    public function getAdop_dueño(){
        return $this->adop_dueño;
    }
    public function getAdop_razon(){
        return $this->adop_razon;
    }
    public function getAdop_observaciones(){
        return $this->adop_observaciones;
    }
    public function getAdop_fecha(){
        return $this->adop_fecha;
    }
    public function getAdop_ultima_visita(){
        return $this->adop_ultima_visita;
    }
    public function getAdop_resumen_visitas(){
        return $this->adop_resumen_visitas;
    }
   
    

    public function setUsr_id($usr_id){
        $this->usr_id = $usr_id;
    }
    public function setRol_id($rol_id){
        $this->rol_id = $rol_id;
    }
    public function setPerro_id($perro_id){
        $this->perro_id = $perro_id;
    }
    public function setAdop_dueño($adop_dueño){
        $this->adop_dueño = $adop_dueño;
    }
    public function setAdop_razon($adop_razon){
        $this->adop_razon = $adop_razon;
    }
    public function setAdop_observaciones($adop_observaciones){
        $this->adop_observaciones = $adop_observaciones;
    }
    public function setAdop_fecha($adop_fecha){
        $this->adop_fecha = $adop_fecha;
    }
    public function setAdop_ultima_visita($adop_ultima_visita){
        $this->usr_apellido_maadop_ultima_visitaterno = $adop_ultima_visita;
    }
    public function setAdop_resumen_visitas($adop_resumen_visitas){
        $this->adop_resumen_visitas = $adop_resumen_visitas;
    }
   
}


?>