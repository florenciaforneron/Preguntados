<?php

class partidaModel{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function list(): array
    {
        return array();
    }

    public function getPreguntas(){
        $sql="SELECT pregunta.*, respuesta.A, respuesta.B FROM pregunta JOIN respuesta ON pregunta.id = respuesta.id WHERE pregunta.enviada = 0 ORDER BY RAND()";
        $unaPregunta= $this->database->singleQuery($sql);
        if($unaPregunta!=null){
            $id = $unaPregunta['id'];
            $this->preguntaEnJuego($id);
        } else {
            $this->resetearPartida();
            $unaPregunta= $this->database->singleQuery($sql);
        }
        return $unaPregunta;
    }

    public function getRespuesta(){
        $preguntaAResponder=$this->getPreguntas();
        $idPregunta = $preguntaAResponder['id'];
        $sql = "SELECT * FROM respuesta WHERE $idPregunta=id ";
        $unaRespuesta= $this->database->singleQuery($sql);
        return $unaRespuesta;
    }

    function preguntaEnJuego($id)
    {
        $sql = "UPDATE pregunta SET enviada = 1 WHERE pregunta.id = '$id'";
        $this->database->update($sql);
    }

    public function resetearPartida(){
        $sql="UPDATE `pregunta` SET `enviada` = '0' WHERE id IN (SELECT id FROM pregunta where enviada = 1)";
        $this->database->query($sql);
    }

    public function iniciarPartida($usuario){
        $idUsuario=$this->getIdUsuario($usuario);
        $sql="INSERT INTO `partida` (`id_usuario`, `puntaje`, `fecha`) VALUES ('$idUsuario', '0', current_timestamp());";
        $this->database->query($sql);
    }

    public function traerRespuestaCorrecta($idPregunta){
        $sql="SELECT opcionCorrecta FROM respuesta WHERE id_pregunta = '$idPregunta'";
        $var=$this->database->query($sql);
        $resultado=$var[0]['opcionCorrecta'];
        return $resultado;
    }
    public function terminarPartida($usuario){
        $idUsuario=$this->getIdUsuario($usuario);
        $puntajeFinal=$_SESSION['puntaje'];
        $sql="INSERT INTO `partida` (`id_usuario`, `puntaje`, `fecha`) VALUES ('$idUsuario', $puntajeFinal, current_timestamp());";
        $this->database->query($sql);
        $_SESSION['puntajeFinal']=$_SESSION['puntaje'];
        $_SESSION['puntaje']=0;
    }

    public function getIdUsuario($usuario){
        $sql="SELECT id FROM usuario WHERE nombre_usuario = '$usuario'";
        $var=$this->database->query($sql);
        $resultado=$var[0]['id'];

        return $resultado;
    }

    public function reportarPregunta($idPregunta){
        $sql="UPDATE pregunta SET id_estado = 3 WHERE id = '$idPregunta'";
        if($this->consultarSiLaPreguntaEstaReportada($idPregunta)){
            $this->database->query($sql);
            return true;
        }else {
            return false;
        }
    }

    public function consultarSiLaPreguntaEstaReportada($idPregunta){
        $sql="SELECT id_estado from PREGUNTA WHERE id = '$idPregunta'";
        $resultado=$this->database->query($sql);
        if($resultado==2){
            return false; //pregunta no reportada aún
        }return true;  //pregunta ya reportada.
    }

    public function getPuntajeMaxDeUsuario($usuario){
        $sql="SELECT puntaje_max FROM usuario WHERE nombre_usuario = '$usuario'";
        $var=$this->database->query($sql);
        $resultado=$var[0]['puntaje_max'];

        return $resultado;
    }

}