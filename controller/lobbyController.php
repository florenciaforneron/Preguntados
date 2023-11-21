<?php

class lobbyController
{
    private $render;
    private $model;

    public function __construct($render, $model)
    {
        $this->render = $render;
        $this->model = $model;
    }

    public function list()
    {
        if (!isset($_SESSION["usuario"]))
            Redirect::to("/home");


            $data=['datosUsuario'=>$this->model->getDatosDelUsuario($_SESSION['usuario'])];


            if($_SESSION["idRol"] == 1){
                $this->render->printView('admin', $data);
            }

            if($_SESSION["idRol"] == 2){
                $this->render->printView('editor', $data);
            }

            if($_SESSION["idRol"] == 3){
                $data['ranking'] = $this->model->getRanking();
                $this->render->printView('lobby', $data);
            }

    }



}