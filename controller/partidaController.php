<?php

class partidaController{
    private $render;
    private $model;

    public function __construct($render, $model) {
        $this->render = $render;
        $this->model = $model;
    }

    public function list() {
        if(!isset($_SESSION["usuario"]))
            Redirect::to("/lobby");
        $data = [];
        $this->render->printView('home', $data);
    }

    public function jugarPartida(){
        if (!isset($_SESSION["usuario"])) {
            Redirect::to("/home");
        } else{
            ini_set('display_errors', 0);
            error_reporting(E_ALL);
            if($_SESSION['flag']==1){
                $this->cerrarPartida();
            }
                $_SESSION['flag']=1;
                $data=['preguntas'=>$this->model->getPreguntas(),'countdown'=>10];$_SESSION['puntaje']=0;
                $_SESSION['idDePregunta'] = $data['preguntas']['id'];
                if ($data['preguntas']==NULL) {
                    $this->model->resetearPartida();
                } else {
                    $this->render->printView('partida', $data);
                }
        }
    }

    public function verificarRespuesta(){
        $respuestaSeleccionada1=$_POST['1']??'';

        if($respuestaSeleccionada1==''){
            $respuestaSeleccionada='B';
        }else{
            $respuestaSeleccionada='A';
        }

        $idPregunta=$_POST['id'];

        $respuestaCorrecta=$this->model->traerRespuestaCorrecta($idPregunta);

        if($respuestaSeleccionada==$respuestaCorrecta){
            if($this->verificarIdDePregunta($idPregunta)){
                $this->cerrarPartida();
            }
            $_SESSION['puntaje']+=1;
            $this->siguientePregunta();
        }else {
            $this->cerrarPartida();
        }
    }

    public function verificarIdDePregunta($idPregunta){
        if ($_SESSION['idDePregunta']!=$idPregunta) {
            return true;
            //$this->cerrarPartida();
        }else return false;
    }

    public function cerrarPartida(){
        $_SESSION['flag']=0;
        $this->model->terminarPartida($_SESSION['usuario']);
        $this->model->resetearPartida();
        Redirect::to("/lobby");
    }

    public function siguientePregunta(){
        if (!isset($_SESSION["usuario"])) {
            Redirect::to("/home");
        }else{
            $data=['preguntas'=>$this->model->getPreguntas(),'countdown'=>10];
            $_SESSION['idDePregunta'] = $data['preguntas']['id'];
            $this->render->printView('partida', $data);
        }
    }

    public function reportarPregunta(){
        $idPreguntaReportada=$_POST['id'];
        if($this->model->reportarPregunta($idPreguntaReportada)){
            $data=['msj'=>"Pregunta reportada, nuestros moderadores tendrán en cuenta ésto. ¡Gracias!"];
        }else {
            $data=['msj'=>"Pregunta ya reportada con anterioridad, lo tendremos en cuenta"];
        }

        $this->render->printView('preguntaReportada',$data);
    }

}