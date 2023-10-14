<?php

class homeController {
    private $render;
    private $model;
    private $sessionManager;

    public function __construct($render, $model, $sessionManager) {
        $this->render = $render;
        $this->model = $model;
        $this->sessionManager = $sessionManager;
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

    public function login(){

        if ($this->sessionManager->get('idUser') == null){
            $usuario = $_POST['usuario'];
            $contrasenia = $_POST['password'];

            $usuarioConectado = $this->model->usuarioPorNombreYContrasenia($usuario, $contrasenia);

            if(sizeof($usuarioConectado) == 1){
                $this->setSesionUsuario($usuarioConectado);

                Redirect::root();
            }

        }

    }

    public function setSesionUsuario($usuario){
        $this->sessionManager->set("nombreUsuario", $usuario[0]['nombre_usuario']);
        //$this->sessionManager->set("idUsuario", $usuario[0]['id_usuario']);
    }

    public function logout()
    {

        $this->sessionManager->destroy();
        header("Location: /home");
        exit();
    }

    public function displays(){

    }








}