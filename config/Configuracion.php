<?php
include_once('helper/Database.php');
include_once('helper/Render.php');
include_once('helper/MustacheRender.php');
include_once("helper/Router.php");
include_once("helper/Logger.php");
include_once('helper/Redirect.php');
include_once ('helper/SessionManager.php');

include_once('controller/homeController.php');
include_once("model/homeModel.php");

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
        //return new Render("view/header.php", "view/footer.php");
        return new MustacheRender();
    }

    public function getSessionManager(){
        return new SessionManager();
    }


    public function getHomeController() {
        $model = new homeModel($this->getDatabase());
        return new homeController($this->getRender(), $model, $this->getSessionManager());
    }

    public function getRouter() {
        return new Router($this,"getHomeController","list");
    }
}
