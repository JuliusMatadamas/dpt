<?php

namespace app\core;

class App
{
    public Router $router;
    public function __construct()
    {
        $this->router = new Router();
    }
}