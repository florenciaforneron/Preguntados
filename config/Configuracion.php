<?php
include_once('helper/Database.php');
include_once('helper/Render.php');
include_once('helper/MustacheRender.php');
include_once("helper/Router.php");
include_once("helper/Logger.php");
include_once('helper/Redirect.php');


include_once ('controller/lobbyController.php');
include_once('controller/homeController.php');
include_once('controller/partidaController.php');
include_once('controller/userController.php');
include_once('controller/sugerirPreguntaController.php');
include_once('controller/preguntaController.php');
include_once('controller/editarPreguntaController.php');
include_once('controller/adminController.php');

include_once("model/homeModel.php");
include_once("model/lobbyModel.php");
include_once("model/partidaModel.php");
include_once("model/userModel.php");
include_once("model/preguntaModel.php");
include_once("model/adminModel.php");

include_once('third-party/mustache/src/Mustache/Autoloader.php');

class Configuracion {
    public function __construct() {
    }

    public function getDatabase() {
        $config = parse_ini_file('configuration.ini');
        $database = new Database(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['dbname']
        );
        return $database;
    }

    public function getRender() {
        return new MustacheRender();
    }

    public function getHomeController() {
        $model = new homeModel($this->getDatabase());
        return new homeController($this->getRender(), $model);
    }

    public function getLobbyController() {
        $model = new lobbyModel($this->getDatabase());
        return new lobbyController($this->getRender(), $model);
    }

    public function getPartidaController() {
        $model = new partidaModel($this->getDatabase());
        return new partidaController($this->getRender(), $model);
    }

    public function getUserController() {
        $model = new userModel($this->getDatabase());
        return new userController($this->getRender(), $model);
    }

    public function getSugerirPreguntaController(){
        $model = new preguntaModel($this->getDatabase());
        return new sugerirPreguntaController($this->getRender(), $model);
    }

    public function getPreguntaController(){
        $model = new preguntaModel($this->getDatabase());
        return new preguntaController($this->getRender(), $model);
    }

    public function getEditarPreguntaController(){
        $model = new preguntaModel($this->getDatabase());
        return new editarPreguntaController($this->getRender(), $model);
    }

    public function getAdminController(){
        $model = new adminModel($this->getDatabase());
        return new adminController($this->getRender(), $model);
    }


    public function getRouter() {
        return new Router($this,"getHomeController","list");
    }
}
