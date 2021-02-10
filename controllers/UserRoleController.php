<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\models\UserRolesModel;


class UserRoleController extends Controller
{

    public function userRole()
    {
        $model = new UserRolesModel();

        $dbData = $model->positionWithPagination(0, 10, null);

        echo $this->view("userRoles", "main", $dbData);
    }

    public function edit()
    {
        $model = new UserRolesModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("id = $model->id"));

        echo $this->view("userRoleUpdate", "main", $model);
    }

    public function editProcess()
    {
        $model = new UserRolesModel();

        $model->loadData($this->request->all());

        $model->validate();

        if ($model->errors === null) {

            if ($model->updateRole($model)) {
                Application::$app->session->setFlash('success', "Uspesno promenjeno!");
                Application::$app->response->redirect("/positions?id=$model->id");
            }
        }


        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/positions?id=$model->id");
    }

    public function athorize()
    {
        return [
            "SuperAdministrator"
        ];
    }
}