<?php

class loginModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function list($filter = "") {
        $usuarios = $this->database->query("SELECT * FROM `usuario` WHERE id LIKE '%$filter%'");
        $result = array();
        Logger::info("Usuarios: " . json_encode($result));

        return $result;
    }






}