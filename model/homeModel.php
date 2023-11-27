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

    public function alta($contrasenia, $usuario, $mail, $nombreCompleto, $fecha_nacimiento, $nacionalidad, $sexo, $imagen) {
        $hashedPassword = md5($contrasenia);
        $sql = "INSERT INTO `usuario` ( `nombre_usuario`, `mail`,  `contrasenia`, `nombreCompleto`, `fecha_nacimiento`, `sexo`, `id_pais`, `fecha_registro`, `foto_perfil`) 
                VALUES ( '$usuario', '$mail', '$hashedPassword', '$nombreCompleto', '$fecha_nacimiento', '$sexo', '$nacionalidad', CURRENT_TIMESTAMP, '$imagen');";
        Logger::info('usuario alta: ' . $sql);

        $this->database->query($sql);
    }

    public function validarUsuario($mail, $usuario_validado) {
        $sql = "SELECT `usuario_validado`, `mail` FROM 'usuario' WHERE 'mail' = '$mail' and 'usuario_validado'='$usuario_validado'";
        Logger::info('Validacion usuario: ' . $sql);

        $this->database->query($sql);
    }

    public function login($usuario, $contrasenia){
        $hashedPassword = md5($contrasenia);
        $sql = "SELECT * FROM 'usuario' WHERE 'nombre_usuario' = '$usuario' AND 'contrasenia' = '$hashedPassword'";
        Logger::info('Usuarios que coinciden: '. $sql);

        $this->database->query($sql);

    }

    public function usuarioPorNombreYContrasenia($usuario, $contrasenia)
    {
        $hashedPassword = md5($contrasenia);
        return $this->database->query("SELECT * FROM usuario WHERE nombre_usuario = '$usuario' and contrasenia = '$hashedPassword'");
    }

    public function getIdRolPorUsuario($user){
       $query = "SELECT id_rol FROM usuario where nombre_usuario = '$user'" ;
       $result = $this->database->singleQuery($query);
       return $result['id_rol'];
    }



}