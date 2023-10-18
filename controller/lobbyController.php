<?php

class lobbyController
{
    private $render;
    private $model;

    public function __construct($render, $model) {
        $this->render = $render;
        $this->model = $model;
    }

    public function list() {
        $this->startSession();
    }

    private function startSession(){
        if(!isset($_SESSION["usuario"]))
            Redirect::to("/home");

        $data = [];
        $this->render->printView('lobby', $data);
    }
}