<?php
class Pedido{
    private $usr_id;
    private $rol_id;
    private $cliente;
    private $dni;
    private $correo;
    private $total;
    private $igv;


    public function __construct($usr_id, $rol_id, $cliente, $dni, $correo, $total, $igv){
        $this->usr_id = $usr_id;
        $this->rol_id = $rol_id;
        $this->cliente = $cliente;
        $this->dni = $dni;
        $this->correo = $correo;
        $this->total = $total;
        $this->igv = $igv;

    }

    public function getUsr_id(){
        return $this->usr_id;
    }
    public function getRol_id(){
        return $this->rol_id;
    }
    public function getCliente(){
        return $this->cliente;
    }
    public function getDni(){
        return $this->dni;
    }
    public function getCorreo(){
        return $this->correo;
    }
    public function getTotal(){
        return $this->total;
    }
    public function getIgv(){
        return $this->igv;
    }



    public function setUsr_id($usr_id){
        $this->usr_id = $usr_id;
    }
    public function setRol_id($rol_id){
        $this->rol_id = $rol_id;
    }
    public function setCliente($cliente){
        $this->cliente = $cliente;
    }
    public function setDni($dni){
        $this->dni = $dni;
    }
    public function setCorreo($correo){
        $this->correo = $correo;
    }
    public function setTotal($total){
        $this->total = $total;
    }
    public function setIgv($igv){
        $this->igv = $igv;
    }

}
?>