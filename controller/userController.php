<?php

class userController
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
        $data=[];
        $this->render->printView('user', $data);
    }

    public function verPerfilDeUsuario(){
        $usuario = $_POST['nombre_usuario'];
        $data=['infoUsuario'=>$this->model->datosDelUsuario($usuario)];
        $this->render->printView('user', $data);
    }

}