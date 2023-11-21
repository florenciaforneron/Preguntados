<?php

class sugerirPreguntaController
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

        $data['user']=$_SESSION['usuario'];
        $this->render->printView('sugerirPregunta', $data);
    }

    public function agregarPregunta(){

        if (!isset($_POST['descripcion']) || !isset($_POST['opcionA']) || !isset($_POST['opcionB']) || !isset($_POST['respuestaCorrecta'])) {
            $_SESSION["error"] = "Error: Todos los campos son obligatorios";
        }

        $descripcion = $_POST['descripcion'];
        $opcionA = $_POST['opcionA'];
        $opcionB = $_POST['opcionB'];
        $respuestaCorrecta = $_POST['respuestaCorrecta'];


        if(!$this->model->buscarPreguntaPorDescripcion($descripcion)){
            $this->model->agregarPregunta($_SESSION['idRol'], $descripcion, $opcionA, $opcionB, $respuestaCorrecta);

            if($_SESSION['idRol'] == 3) {
                $this->render->printView('nuevaPreguntaSugerida');
            } else {
                $this->render->printView('nuevaPreguntaAgregada');
            }

        } else {
            Redirect::to("/lobby");
        }

    }

}