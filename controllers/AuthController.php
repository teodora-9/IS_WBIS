<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\LoginModel;
use app\models\RegisterModel;
use app\models\UserModel;

class AuthController extends Controller
{
    public function login()
    {
        $model = new LoginModel();

        echo $this->view("login", "auth", $model);
    }

    public function loginProcess()
    {
        $model = new LoginModel();
        $userModel = new UserModel();

        $model->loadData($this->request->all());

        $model->validate();


        if ($model->errors === null)
        {
            if ($model->login($model))
            {
                $userData = $userModel->readAllUserData($model->email);

                $userModel->loadData($userData);

                Application::$app->session->setAuth('user', $userModel);
                Application::$app->response->redirect("/profile");
                exit;
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->session->setFlash('errorUser', "Polja nisu validna ili parametri nisu tacni!");
        Application::$app->response->redirect("/login");
    }

    public function register()
    {
        $model = new RegisterModel();

        echo $this->view("register", "auth", $model);
    }

    public function registerProcess()
    {
        $model = new RegisterModel();

        $model->loadData($this->request->all());

        $model->validate();

        if ($model->errors === null)
        {
            if ($model->register($model)){
                Application::$app->session->setFlash('success', "Thank you for registration");
                Application::$app->response->redirect("/register");
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/register");
    }

    public function logout()
    {
        if (Application::$app->session->getAuth('user'))
            Application::$app->session->remove('user');

        Application::$app->response->redirect("/login");
    }

    public function accessDenied()
    {
        echo $this->view("accessDenied", "main", null);
    }

    public function athorize()
    {
        return [
          "Guest"
        ];
    }
}