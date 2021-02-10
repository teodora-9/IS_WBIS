<?php

namespace app\core;

class Application
{
    public Router $router;
    public Session $session;
    public Response $response;
    public static Application $app;

    public function __construct()
    {
        $this->router = new Router();
        $this->session = new Session();
        $this->response = new Response();
        self::$app = $this;
    }

    public function run()
    {
        $this->router->resolve();
    }
}