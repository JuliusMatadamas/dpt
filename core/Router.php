<?php

namespace app\core;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    /**
     * Método para asignar a la propiedad $routes la ruta solicitada mediante el método HTTP get
     * @param $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    /**
     * Método para asignar a la propiedad $routes la ruta solicitada mediante el método HTTP post
     * @param $path
     * @param $callback
     */
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    /**
     * Se inicia la aplicación obtienendo el método y la ruta para después renderizar
     * la vista y ejecutar el método correspondiente
     * @return mixed|string|string[]
     */
    public function resolve()
    {
        $path = $this->request->getPath ();// Se obtiene la ruta
        $method = $this->request->method ();// Se obtiene el tipo de petición HTTP (get, post, put, patch, delete)
        $callback = $this->routes[$method][$path] ?? false;// Se asignan a la propiedad $routes y después a la variable $callback

        // Si la ruta no se encuentra, se renderiza la vista de error
        if ($callback === false)
        {
            $this->response->setStatusCode (404);
            return $this->renderView("not_found");
        }

        // Si la ruta es válida, se renderiza la vista
        if (is_string ($callback))
        {
            return $this->renderView($callback);
        }

        return call_user_func ($callback, $this->request);
    }

    /**
     * Método para renderizar la vista pasada como párametro
     * @param $view - string con el nombre la vista a renderizar
     */
    public function renderView($view, $params)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView ($view, $params);
        // Dentro de la plantilla 'main' se reemplaza el string '{{content}}' con la vista solictada de la ruta
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Metodo para reemplazar el string '{{content}}' por el texto pasado como párametro
     * @param $viewContent
     * @return string|string[]
     */
    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    /**
     * Método para cargar la plantilla principal para las vistas
     * @return false|string
     */
    protected function layoutContent()
    {
        ob_start();
        include_once App::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }

    /**
     * Método para cargar la vista correspondiente a la ruta especificada
     * @param $view
     * @return false|string
     */
    protected function renderOnlyView($view, $params)
    {
        foreach($params as $key => $value)
        {
            $$key = $value;
        }
        ob_start(); // Se indica a PHP que guarde la salida en el bufer
        include_once App::$ROOT_DIR."/views/$view.php"; // se incluye la vista a mostrar
        return ob_get_clean(); // se obtiene el contenido del bufer
    }
}