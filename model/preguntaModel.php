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

    public function buscarPreguntaPorDescripcion($descripcion){
        return $this->database->query("SELECT * FROM pregunta WHERE descripcion = '$descripcion'");
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