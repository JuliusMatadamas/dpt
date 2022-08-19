<?php

namespace app\controllers;

use app\core\App;

class LoginController
{
    public static function index() {
        $params = [];
        return App::$app->router->renderView ("login", $params);
    }

    public static function create() {
    }

    public static function read() {
    }

    public static function update() {
    }

    public static function delete() {
    }

    public static function login() {
        return "data submitted";
    }
}