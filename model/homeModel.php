<?php

class homeModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }


    public function list($filter = "") {
        $result = array();
        return $result;
    }

    public function alta($contrasenia, $usuario) {
        $sql = "INSERT INTO `usuario` ( `nombre_usuario`, `contrasenia`) VALUES ( '$usuario', '$contrasenia');";
        Logger::info('usuario alta: ' . $sql);

        $this->database->query($sql);
    }

    public function login($usuario, $contrasenia){
        $sql = "SELECT * FROM 'usuario' WHERE 'nombre_usuario' = '$usuario' AND 'contrasenia' = '$contrasenia'";
        Logger::info('Usuarios que coinciden: '. $sql);


        $this->database->query($sql);


    }

    public function usuarioPorNombreYContrasenia($user, $pass)
    {
        return $this->database->query("SELECT * FROM usuario WHERE nombre_usuario = '$user' and contrasenia = '$pass'");
    }

    public function getIdRolPorUsuario($user){
       $query = "SELECT id_rol FROM usuario where nombre_usuario = '$user'" ;
       $result = $this->database->singleQuery($query);
       return $result['id_rol'];
    }



}