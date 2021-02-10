<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\UserModel;

class UserController extends Controller
{
    public function profile()
    {
        $model = new UserModel();
        $user = Application::$app->session->getAuth('user');

        $dbData = $model->readAllUserData($user->{'email'});

        $model->loadData($dbData);

        echo $this->view("profile", "main", $model);
    }

    public function profileUpdate()
    {
        $model = new UserModel();

        $model->loadData($this->request->all());

        if ($model->updateUser($model)){
            $userModel = new UserModel();
            $userData = $userModel->readAllUserData($model->email);

            $userModel->loadData($userData);
            Application::$app->session->setAuth('user', $userModel);

            Application::$app->session->setFlash('success', "Uspesno promenjeno!");
            Application::$app->response->redirect("/profile");
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/profile");
    }


    public function athorize()
    {
        return [
            "Korisnik",
            "Administrator",
            "SuperAdministrator"
        ];
    }
}