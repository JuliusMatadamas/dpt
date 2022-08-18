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

    /**
     * Se inicia la aplicación obtienendo el método y la ruta para después renderizar
     * la vista y ejecutar el método correspondiente
     * @return mixed|string|string[]
     */
    public function resolve()
    {
        $path = $this->request->getPath ();// Se obtiene la ruta
        $method = $this->request->getMethod ();// Se obtiene el tipo de petición HTTP (get, post, put, patch, delete)
        $callback = $this->routes[$method][$path] ?? false;// Se asignan a la propiedad $routes y después a la variable $callback

        // Si la ruta no se encuentra, se renderiza la vista de error
        if ($callback === false)
        {
            return $this->renderView("not_found");
        }

        // Si la ruta es válida, se renderiza la vista
        if (is_string ($callback))
        {
            return $this->renderView($callback);
        }

        return call_user_func ($callback);
    }

    /**
     * Método para renderizar la vista pasada como párametro
     * @param $view - string con el nombre la vista a renderizar
     */
    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView ($view);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once App::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once App::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }
}