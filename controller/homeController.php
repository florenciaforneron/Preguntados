<?php

class homeController {
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
        if( isset($_SESSION["usuario"]) )
          Redirect::to("/lobby");

        $data = [];
        $this->render->printView('home', $data);
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
    public function login(){

        $usuario = $_POST['usuario'];
        $contrasenia = $_POST['password'];
        $usuarioConectado = $this->model->usuarioPorNombreYContrasenia($usuario, $contrasenia);

        if(sizeof($usuarioConectado)==1 ){
            $_SESSION["usuario"]=$usuario;
            $data = [$usuario];
            $this->render->printView('lobby', $data);
            Redirect::to("/lobby");
        }else Redirect::to("/home");
    }
    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: /home");
        exit();
    }






}