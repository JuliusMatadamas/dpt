<?php

namespace app\core;

class App
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public static App $app;

    // Constructor de la clase
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database();
    }

    /**
     * Se inicia la aplicación llmando a la clase 'resolve' de la clase 'Router'
     */
    public function run()
    {
        echo $this->router->resolve();
    }
}