<?php

class userModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }


    public function list($filter = "") {
        $result = array();
        return $result;
    }

    public function datosDelUsuario($usuario){
        $sql="SELECT * FROM usuario WHERE nombre_usuario = '$usuario'";
        $var=$this->database->query($sql);
        $resultado=$var;
        return $resultado;
    }

    public function getIdUsuario($usuario){
        $sql="SELECT Id FROM usuario WHERE nombre_usuario = '$usuario'";
        $var=$this->database->query($sql);
        $resultado=$var;
        return $resultado;
    }

    public function getRolUsuario($usuario){

    }
}