<?php

class homeController {
    private $render;
    private $model;

    public function __construct($render, $model) {
        $this->render = $render;
        $this->model = $model;
    }

    public function list() {
        $busqueda = $_GET['search'] ?? '';
        $datos["pokemon"] = $this->model->list($busqueda);
        $this->render->printView('home', $datos);
    }

    public function alta(){
        $data = [];

        if(!empty($_SESSION['error'])){
            $data["error"] = $_SESSION['error'];
            unset( $_SESSION['error']);
        }

        $data['action'] = '/home/procesarAlta';
        $data['submitText'] = 'Crear';
        $this->render->printView('formAlta', $data);
    }

    public function procesarAlta(){


        if( empty($_POST['contrasenia'] ) || empty($_POST['usuario'] )  ){
            $_SESSION["error"] = "Alguno de los campos era erroneo o vacio";
            Redirect::to('/home/alta');
        }

        $contrasenia = $_POST["contrasenia"];
        $usuario = $_POST['usuario'];


        $this->model->alta($contrasenia, $usuario);
        Redirect::root();
    }




}