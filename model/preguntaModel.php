<?php

class preguntaModel
{
    private $database;

    public function __construct($database) {
        $this->database = $database;
    }

    public function list($filter = "") {
        $result = array();
        return $result;
    }

    public function getPreguntasSugeridas(){
        return $this->database->query("SELECT * FROM pregunta AS p JOIN respuesta AS r ON p.id=r.id_pregunta WHERE id_estado = 1");
    }

    public function getPreguntasAceptadas(){
        return $this->database->query("SELECT * FROM pregunta AS p JOIN respuesta AS r ON p.id=r.id_pregunta WHERE id_estado = 2");
    }

    public function getPreguntasReportadas(){
        return $this->database->query("SELECT * FROM pregunta AS p JOIN respuesta AS r ON p.id=r.id_pregunta WHERE id_estado = 3");
    }

    public function buscarPreguntaPorDescripcion($descripcion){
        return $this->database->query("SELECT * FROM pregunta WHERE descripcion = '$descripcion'");
    }

    public function buscarPreguntaPorId($id){
        return $this->database->query("SELECT * FROM pregunta WHERE id = '$id'");
    }

    public function aceptarPregunta($id){
        $this->database->update("UPDATE pregunta SET id_estado = 2 WHERE id = '$id'");
    }

    public function borrarPregunta($id){
        $this->database->update("DELETE FROM respuesta WHERE id_pregunta = '$id'");
        $this->database->update("DELETE FROM pregunta WHERE id = '$id'");
    }

    public function agregarPregunta($idRol, $descripcion, $opcionA, $opcionB, $respuestaCorrecta){

        $idEstado = 0;
        if ($idRol == 3){
            $idEstado = 1;
        }
        if ($idRol == 2){
            $idEstado = 2;
        }

        $queryPregunta = "INSERT INTO pregunta (descripcion, id_estado)
              VALUES ('$descripcion', '$idEstado')";
        $this->database->update($queryPregunta);


        $queryIdPregunta="SELECT LAST_INSERT_ID() AS id_pregunta FROM pregunta";
        $result=$this->database->singleQuery($queryIdPregunta);
        $id_pregunta=$result['id_pregunta'];


        $queryRespuestas = "INSERT INTO respuesta (id_pregunta, A, B, opcionCorrecta)
              VALUES ('$id_pregunta', '$opcionA', '$opcionB', '$respuestaCorrecta')";
        $this->database->update($queryRespuestas);
    }


}