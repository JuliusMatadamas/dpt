<?php

namespace app\core;

class App
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;

    // Constructor de la clase
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    /**
     * Se inicia la aplicación llmando a la clase 'resolve' de la clase 'Router'
     */
    public function run()
    {
        echo $this->router->resolve();
    }
}