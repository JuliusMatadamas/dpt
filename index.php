<?php

/**
 * ================================================================================================
 * Se incluye el archivo autoload.php para cargar cada clase que sea creada
 * ================================================================================================
 */
require_once __DIR__ . '/vendor/autoload.php';

use app\controllers\LoginController;
use app\core\App;

// Variable con la dirección absoluta del sitio en el servidor
$dirname = dirname(__DIR__) . '/' . $_SERVER["HTTP_HOST"];

/**
 * ================================================================================================
 * Se crea una nueva instancia de la clase App y se le pasa como párametro la dirección absoluta
 * ================================================================================================
 */
$app = new App($dirname);


/**
 * ================================================================================================
 * Rutas de la aplicación
 * ================================================================================================
 */
$app->router->get ('/', 'home');
$app->router->get ('/home', 'home');
$app->router->get ('/inicio', 'home');
$app->router->get ('/login', [LoginController::class, 'index']);
$app->router->post ('/login', [LoginController::class, 'login']);


/**
 * ================================================================================================
 * Se ejecuta la aplicación
 * ================================================================================================
 */
$app->run ();