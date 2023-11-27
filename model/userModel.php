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
        $sql="SELECT u.nombre_usuario AS usuario, u.nombreCompleto AS nombre_completo, u.puntaje_max AS puntaje_maximo, 
                    TIMESTAMPDIFF(YEAR, fecha_nacimiento, CURDATE()) AS edad, u.sexo AS genero, p.nombre AS pais
                FROM usuario AS u JOIN pais AS p ON u.id_pais = p.id WHERE u.nombre_usuario = '$usuario'";
        $var=$this->database->query($sql);
        return $var;
    }

    public function getFotoPerfil($usuario){
        return $this->database->query("SELECT foto_perfil FROM usuario WHERE nombre_usuario = '$usuario'");
    }

    public function getUltimasCincoPartidasJugadas($usuario){
        $query = "SELECT p.puntaje, p.fecha 
                    FROM partida AS p JOIN usuario AS u ON p.id_usuario=u.Id 
                    WHERE u.nombre_usuario = '$usuario' ORDER BY p.fecha DESC LIMIT 5";
        return $this->database->query($query);
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