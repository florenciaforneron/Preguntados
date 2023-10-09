<?php

class homeModel {
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }


   public function list($filter = "") {
        $usuarios = $this->database->query("SELECT * FROM `usuario` WHERE id LIKE '%$filter%'");
        $result = array();
        Logger::info("Pokemons: " . json_encode($result));

        return $result;
    }

    public function alta($contrasenia, $usuario) {
        $sql = "INSERT INTO `usuario` ( `nombre_usuario`, `contrasenia`) VALUES ( '$usuario', '$contrasenia');";
        Logger::info('usuario alta: ' . $sql);

        $this->database->query($sql);
    }

}