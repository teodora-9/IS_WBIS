<?php


namespace app\core;


abstract class Controller
{
    public Router $router;
    public Request  $request;
    public Response  $response;

    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();
        $this->response = new Response();

        $roles = $this->athorize();
        $user = Application::$app->session->getAuth('user');
        $this->checkRole($roles, $user);
    }

    public function view($view, $layout, $params)
    {
        return $this->router->renderView("$view", "$layout", $params);
    }

    abstract public function athorize();

    public function checkRole($roles, $user)
    {
        $access = false;
        $guestAccess = false;

        if ($user !== false) {
            foreach ($roles as $mehod=>$role) {
                if ($role !== $user->{'roleName'}) {
                } else {
                    $access = true;
                }
            }

            if (!$access) {
                Application::$app->response->redirect("/accessDenied");
            }
        }

        foreach ($roles as $role) {
            if ($role === "Guest") {
                $guestAccess = true;
            }
        }

        if (!$guestAccess and !$access) {
            Application::$app->response->redirect("/login");
        }
    }
}