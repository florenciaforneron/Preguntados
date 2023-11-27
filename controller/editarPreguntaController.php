<?php

class editarPreguntaController
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
        if (!isset($_SESSION["usuario"]) || $_SESSION["idRol"]==3)
            Redirect::to("/lobby");

        $idPregunta=$_POST["id"];
        $data['user']=$_SESSION['usuario'];

        if ($idPregunta !== null){
            $data['pregunta'] =  $this->model->buscarPreguntaPorId($idPregunta);
        }

        $this->render->printView('editarPregunta', $data);
    }

    public function editar()
    {
        $parametrosRequeridos = ['id', 'descripcion', 'id_categoria', 'opcionA', 'opcionB', 'opcionC', 'opcionD', 'resp_correcta'];

        foreach ($parametrosRequeridos as $parametro) {
            if (!isset($_POST[$parametro]) || empty($_POST[$parametro])) {
                echo "No se pudo editar, falta el parámetro: " . $parametro;
            }
        }

        $id = $_POST['id'];
        $descripcion = $_POST['descripcion'];
        $idCategoria = $_POST['id_categoria'];
        $opcionA = $_POST['opcionA'];
        $opcionB = $_POST['opcionB'];
        $opcionC = $_POST['opcionC'];
        $opcionD = $_POST['opcionD'];
        $opcionCorrecta = $_POST['opcionCorrecta'];
        $idEstado=$this->model->buscarPreguntaPorId($id);

        $this->model->editarPregunta($id, $descripcion, $idCategoria, $opcionA, $opcionB, $opcionC, $opcionD, $opcionCorrecta);

        foreach ($parametrosRequeridos as $parametro) {
            unset($_POST[$parametro]);
        }

        $this->redirect($idEstado[0]["id_estado"]);
    }

    private function redirect($idEstado){
        switch ($idEstado) {
            case 1:
                $location = "/pregunta/sugeridas";
                break;
            case 2:
                $location = "/pregunta/aceptadas";
                break;
            case 3:
                $location = "/pregunta/reportadas";
                break;
            default:
                $location = "/pregunta/aceptadas";
                break;
        }
        Redirect::to($location);
    }


}