<?php
class DataBase{
    private $conexion;
    public function __construct()
    {

        $this->conexion = new mysqli("localhost",
            "root",
            "",
            "pokedex");
    }
    public function query($sql){
        $respuesta =  $this->conexion->query($sql);
        if($respuesta){
            return $respuesta->fetch_all(MYSQLI_ASSOC);
        } else {
            return null;
        }

    }
    public function __destruct (){
        $this->conexion->close();
    }
    public function execute($sql){
        $this->conexion->query($sql);
    }

    public function darAltaPokemon($numero,$tipo,$nombre,$descripcion,$imagen){
        return $this->execute("INSERT INTO pokemon ( nombre , imagen, tipo, descripcion, identificador) VALUES ('".$nombre."','".$imagen."','".$tipo."','".$descripcion."','".$numero."')");
    }
}