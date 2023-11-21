<?php

class preguntaController
{
    private $render;
    private $model;

    public function __construct($render, $model)
    {
        $this->render = $render;
        $this->model = $model;
    }



    public function aceptadas()
    {
        if (!isset($_SESSION["usuario"]) || $_SESSION["idRol"]==3)
            Redirect::to("/lobby");

        $nombreUsuario = $_SESSION["usuario"];
        $data = [
            'nombre_usuario' => $nombreUsuario,
            'preguntasAceptadas' => $this->model->getPreguntasAceptadas(),
            'editar' => true
        ];

        $this->render->printView("pregunta", $data);
    }


    public function sugeridas()
    {
        if (!isset($_SESSION["usuario"]) || $_SESSION["idRol"]==3)
            Redirect::to("/lobby");

        $nombreUsuario = $_SESSION["usuario"];
        $data = [
            'nombre_usuario' => $nombreUsuario,
            'preguntasSugeridas' => $this->model->getPreguntasSugeridas(),
            'sugerida' => true
        ];

        $this->render->printView("pregunta", $data);
    }

    public function reportadas()
    {
        if (!isset($_SESSION["usuario"]) || $_SESSION["idRol"]==3)
            Redirect::to("/lobby");

        $nombreUsuario = $_SESSION["usuario"];
        $data = [
            'nombre_usuario' => $nombreUsuario,
            'preguntasReportadas' => $this->model->getPreguntasReportadas(),
            'reportada' => true
        ];

        $this->render->printView("pregunta", $data);
    }


    public function aceptar()
    {
        if (!isset($_SESSION["usuario"]) || $_SESSION["idRol"]==3)
            Redirect::to("/lobby");

        $id = $_POST["id"];
        $idEstado=$this->model->buscarPreguntaPorId($id);
        $this->model->aceptarPregunta($id);
        $this->redirect($idEstado[0]["id_estado"]);

    }

    public function borrar()
    {
        if (!isset($_SESSION["usuario"]) || $_SESSION["idRol"]==3)
            Redirect::to("/lobby");

        $id = $_POST["id"];
        $idEstado=$this->model->buscarPreguntaPorId($id);
        $this->model->borrarPregunta($id);
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