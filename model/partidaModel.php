<?php

class partidaModel{
    private $database;
    public function __construct($database) {
        $this->database = $database;
    }

    public function list(): array    {
        return array();
    }
    public function getPregunta(){
        if($this->esNovato()){
            $sql=$this->traerPreguntaFacil();
        }else{
            $sql=$this->traerPreguntaDificil();
        }
        $unaPregunta= $this->database->singleQuery($sql);
        if($unaPregunta==null){
            $sql="SELECT pregunta.*, respuesta.A, respuesta.B, respuesta.C, respuesta.D
            FROM pregunta JOIN respuesta ON pregunta.id = respuesta.id_pregunta
            WHERE pregunta.enviada = 0 ORDER BY RAND()";
            $unaPregunta=$this->database->singleQuery($sql);
        }else{
            $this->preguntaEnviada($unaPregunta['id']);
        }
        $this->promedioPregunta($unaPregunta['id']);
        $this->promedioJugador();
        return $unaPregunta;
    }

    public function getRespuesta(){
        $preguntaAResponder=$this->getPregunta();
        $idPregunta = $preguntaAResponder['id'];
        $sql = "SELECT * FROM respuesta WHERE $idPregunta=id ";
        return $this->database->query($sql);

    }

    function preguntaEnviada($id){
        $sql = "UPDATE pregunta SET enviada = 1 WHERE pregunta.id = '$id'";
        $this->database->update($sql);
    }

    public function resetearPartida(){
        $sql="UPDATE `pregunta` SET `enviada` = '0' WHERE id IN (SELECT id FROM pregunta where enviada = 1)";
        $this->database->update($sql);
    }

    public function traerRespuestaCorrecta($idPregunta){
        $sql="SELECT opcionCorrecta FROM respuesta WHERE id_pregunta = '$idPregunta'";
        $var=$this->database->query($sql);
        return $var[0]['opcionCorrecta'];
    }

    public function iniciarPartida($usuario){
        $idUsuario=$this->getIdUsuario($usuario);
        $sql="INSERT INTO `partida` (`id_usuario`, `puntaje`, `fecha`) VALUES ('$idUsuario', '0', current_timestamp());";
        $this->database->query($sql);
    }

    public function terminarPartida($usuario){
        $idUsuario=$this->getIdUsuario($usuario);
        $puntajeFinal=$_SESSION['puntaje'];
        $sql="INSERT INTO `partida` (`id_usuario`, `puntaje`, `fecha`) VALUES ('$idUsuario', $puntajeFinal, current_timestamp());";
        $this->database->query($sql);
        //$queryPuntajeMax;
        $_SESSION['puntajeFinal']=$_SESSION['puntaje'];
        $_SESSION['puntaje']=0;
    }

    public function getIdUsuario($usuario){
        $sql="SELECT id FROM usuario WHERE nombre_usuario = '$usuario'";
        $var=$this->database->query($sql);
        return $var[0]['id'];
    }
    public function reportarPreguntaModel($idPregunta): bool{
        $sql="UPDATE pregunta SET id_estado = 3 WHERE id = '$idPregunta'";
        if($this->consultarSiLaPreguntaEstaReportada($idPregunta)){
            $this->database->query($sql);
            return true;
        }else {
            return false;
        }
    }

    public function consultarSiLaPreguntaEstaReportada($idPregunta): bool{
    $sql="SELECT id_estado from PREGUNTA WHERE id = '$idPregunta'";
    $resultado=$this->database->query($sql);
    if($resultado==2){
        return false; //pregunta no reportada aún
    }return true;  //pregunta ya reportada.
}
    public function esNovato(): bool{
        $nombre_usuario = $_SESSION["usuario"];
        $sql_usuario_novato = "SELECT usuario.* FROM usuario WHERE usuario.nombre_usuario LIKE '$nombre_usuario' AND usuario.novato IS TRUE";
        $resultado = $this->database->query($sql_usuario_novato);

        if ($resultado != null) {
            return true;
        }   else {
                return false;
            }
    }
    public function traerPreguntaFacil(): string{
        return "SELECT pregunta.*, respuesta.A, respuesta.B, respuesta.C, respuesta.D
                FROM pregunta JOIN respuesta ON pregunta.id = respuesta.id_pregunta
                WHERE pregunta.enviada = 0 AND pregunta.es_facil AND pregunta.id_estado=2 IS TRUE             
                ORDER BY RAND()";
    }

    public function traerPreguntaDificil(): string{
        return "SELECT pregunta.*, respuesta.A, respuesta.B, respuesta.C, respuesta.D
                FROM pregunta JOIN respuesta ON pregunta.id = respuesta.id_pregunta
                WHERE pregunta.enviada = 0 AND pregunta.es_facil AND pregunta.id_estado=2 IS FALSE             
                ORDER BY RAND()";
    }

    public function sumarRespuestaCorrectaPregunta($idPregunta){
        $sql="UPDATE pregunta SET veces_bien=veces_bien + 1 WHERE id = '$idPregunta'";
        $this->database->update($sql);
    }
    public function sumarRespuestaIncorrectaPregunta($idPregunta){
        $sql="UPDATE pregunta SET veces_mal=veces_mal + 1 WHERE id = '$idPregunta'";
        $this->database->update($sql);
    }

    public function sumarRespuestaCorrectaUsuario($us){
        $sql="UPDATE usuario SET veces_bien=veces_bien + 1 WHERE nombre_usuario LIKE '$us'";
        $this->database->update($sql);
    }

    public function sumarRespuestaIncorrectaUsuario($us){
        $sql="UPDATE usuario SET veces_mal=veces_mal + 1 WHERE nombre_usuario LIKE '$us'";
        $this->database->update($sql);
    }
    public function promedioPregunta($idPregunta){
        $sql = "SELECT pregunta.veces_bien, pregunta.veces_mal FROM pregunta WHERE id='$idPregunta' ";
        $var=$this->database->singleQuery($sql);

        $bien=$var['veces_bien'];
        $mal=$var['veces_mal'];
        $total=$bien+$mal;

        if(!$total<=0) {
            $prom = $bien * 100 / $total;
        }else $prom=1;

        if ($prom>70.00) {
            $sql1 = "UPDATE pregunta SET es_facil=TRUE WHERE id = '$idPregunta'";
        }else{
            $sql1 = "UPDATE pregunta SET es_facil=FALSE WHERE id = '$idPregunta'";
        }
        $this->database->update($sql1);
    }

    public function promedioJugador(){

        $us=$_SESSION["usuario"];
        $sql = "SELECT usuario.veces_bien, usuario.veces_mal FROM usuario WHERE nombre_usuario='$us'";
        $var=$this->database->singleQuery($sql);

        $bien=$var['veces_bien'];
        $mal=$var['veces_mal'];
        $total=$bien+$mal;

        if(!$total<=0) {
            $prom = $mal * 100 / $total;
        }else $prom=1;

        if ($prom>70.00) {
            $sql1 = "UPDATE usuario SET novato=TRUE WHERE nombre_usuario = '$us'";
        }else{
            $sql1 = "UPDATE usuario SET novato=FALSE WHERE  nombre_usuario = '$us'";
        }
        $this->database->update($sql1);
    }
}
