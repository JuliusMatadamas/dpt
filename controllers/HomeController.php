<?php

namespace app\controllers;

use app\core\App;

class HomeController
{
    public static function index() {
        $params = [];
        return App::$app->router->renderView ("home", $params);
    }
}