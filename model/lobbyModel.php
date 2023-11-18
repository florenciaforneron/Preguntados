<?php

class lobbyModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }


    public function list($filter = "") {
        $result = array();
        return $result;
    }

    public function getDatosDelUsuario($nombreDelUsuario){
        $sql="SELECT * FROM usuario WHERE nombre_usuario = '$nombreDelUsuario'";
        $resultado=$this->database->query($sql);
        return $resultado;
    }

    public function getRanking(){
        //$sql="SELECT * FROM partida WHERE puntaje = (SELECT MAX(puntaje) FROM partida)";
        //$sql="SELECT * FROM partida ORDER BY puntaje DESC";
        $sql="SELECT * FROM usuario ORDER BY puntaje_max DESC";
        $resultado=$this->database->query($sql);
        return $resultado;
    }
}