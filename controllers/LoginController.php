<?php

namespace app\controllers;

use app\core\App;
use app\core\Request;

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

    public static function login(Request $request) {
        $body = $request->getBody (); // Se obtienen los párametros
        return "data submitted";
    }
}