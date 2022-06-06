<?php

class suscripcion{
    private $usr_id;
    private $rol_id;
    private $tipo_id;
    private $suscrip_estado;
    private $suscrip_fecha_inicio;

    public function __construct($usr_id, $rol_id, $tipo_id, $suscrip_estado, $suscrip_fecha_inicio){
        $this->usr_id = $usr_id;
        $this->rol_id = $rol_id;
        $this->tipo_id = $tipo_id;
        $this->suscrip_estado = $suscrip_estado;
        $this->suscrip_fecha_inicio = $suscrip_fecha_inicio;
    }


    public function getUsr_id(){
        return $this->usr_id;
    }
    public function getRol_id(){
        return $this->rol_id;
    }
    public function getTipo_id(){
        return $this->tipo_id;
    }
    public function getSuscrip_estado(){
        return $this->suscrip_estado;
    }
    public function getSuscrip_fecha_inicio(){
        return $this->suscrip_fecha_inicio;
    }


    public function setUsr_id($usr_id){
        $this->usr_id = $usr_id;
    }
    public function setRol_id($rol_id){
        $this->rol_id = $rol_id;
    }
    public function setTipo_id($tipo_id){
        $this->tipo_id = $tipo_id;
    }
    public function setSuscrip_estado($suscrip_estado){
        $this->suscrip_estado = $suscrip_estado;
    }
    public function setSuscrip_fecha_inicio($suscrip_fecha_inicio){
        $this->suscrip_fecha_inicio = $suscrip_fecha_inicio;
    }
    

}

?>