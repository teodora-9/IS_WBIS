<?php

namespace app\core;

class Router
{
    public array $routes = [];
    public Request $request;

    public function __construct()
    {
        $this->request = new Request();
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            http_response_code(404);
            echo $this->renderView("notFound", "empty", null);
            exit;
        }

        if (is_string($callback)) {
            echo $this->renderView($callback, "empty", null);
            exit;
        }

        if (is_array($callback)) {
            $callback[0] = new $callback[0]();

        }

        return call_user_func($callback);
    }

    public function renderView($view, $layout, $params)
    {
        $layoutContent = $this->layoutContent($layout);
        $viewContent = $this->renderOnlyView($view, $params);

        $fullView = str_replace("{{ renderSection }}", $viewContent, $layoutContent);

        echo $fullView;
    }

    public function layoutContent($layout)
    {
        ob_start();
        include_once __DIR__ . "/../views/layouts/$layout.php";
        return ob_get_clean();
    }

    public function renderOnlyView($view, $params)
    {
        if ($params !== null){
            foreach ($params as $key => $value) {
                $$key = $value;
            }
        }

        ob_start();
        include_once __DIR__ . "/../views/$view.php";
        return ob_get_clean();
    }
}