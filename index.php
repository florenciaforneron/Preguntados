<?php
include_once ("config/Configuracion.php");
include_once ('helper/SessionManager.php');

$sessionManager = new SessionManager();
$configuracion = new Configuracion();
$router = $configuracion->getRouter();

$controller = $_GET['controller'] ?? "home";
$method = $_GET['method'] ?? 'list';

$router->route($controller, $method);