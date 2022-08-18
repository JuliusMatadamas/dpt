<?php

namespace app\core;

class Router
{
    public Request $request;
    protected array $routes = [];

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath ();// Se obtiene la ruta
        $method = $this->request->getMethod ();// Se obtiene el tipo de petición HTTP (get, post, put, patch, delete)
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false)
        {
            return "Not found";
        }

        // renderizar la vista
        if (is_string ($callback))
        {
            return $this->renderView($callback);
        }

        return call_user_func ($callback);

        /*echo "<pre>";
        var_dump ($callback);
        echo "</pre>";
        exit;*/
    }

    /**
     * Método para renderizar la vista pasada como párametro
     * @param $view - string con el nombre la vista a renderizar
     */
    public function renderView($view)
    {
        include_once __DIR__."/../views/$view.php";
    }
}