<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\PositionModel;

class PositionController extends Controller
{

    public function positions()
    {
        $model = new PositionModel();

        $dbData = $model->positionWithPagination(0, 10, null);

        echo $this->view("positions", "main", $dbData);
    }

    public function positionsJSON()
    {
        $model = new PositionModel();

        $numberOfPage = $this->request->getOne("numberOfPage");
        $numberOfRows = $this->request->getOne("numberOfRows");
        $search = $this->request->getOne("search");

        $dbData = $model->positionWithPagination($numberOfPage, $numberOfRows, $search);

        echo json_encode($dbData);
    }


    public function positionsDropdown()
    {
        $model = new PositionModel();

        $search = $this->request->getOne("id");

        $dbData = $model->positionDropdownSearch($search);

        echo json_encode($dbData);
    }

    /**
     * Edit one object from table customers - get method
     */
    public function edit()
    {
        $model = new PositionModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("id = $model->id"));

        echo $this->view("positionUpdate", "main", $model);
    }

    /**
     * Delete one object from table customers - get method
     */
    public function delete()
    {
        $model = new PositionModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("id = $model->id"));

        echo $this->view("positionDelete", "main", $model);
    }

    /**
     * Edit one object from table customer - post method
     */
    public function editProcess()
    {
        $model = new PositionModel();

        $model->loadData($this->request->all());

        $model->validate();

        if ($model->errors === null) {
            $model->dateUpdated = date('Y-m-d');
            $model->password = password_hash($model->password, PASSWORD_DEFAULT);
            if ($model->active === "on")
                $model->active = true;

            if ($model->updatePosition($model)) {
                Application::$app->session->setFlash('success', "Uspesno promenjeno!");
                Application::$app->response->redirect("/positionEdit?id=$model->id");
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/positionEdit?id=$model->id");
    }

    /**
     * Delete one object from table customer
     */
    public function deleteProcess()
    {
        $model = new PositionModel();

        $model->loadData($this->request->all());

        if ($model->delete("id = $model->id")) {
            Application::$app->session->setFlash('success', "Uspesno obrisano!");
            Application::$app->response->redirect("/positions");
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/positions");
    }

    public function athorize()
    {
        return [
            "SuperAdministrator"
        ];
    }
}