<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\ProductModel;

class ProductController extends Controller
{
    /**
     * List of all products - get method
     */
    public function products()
    {
        echo $this->view("products", "main", null);
    }


    public function reports()
    {
        echo $this->view("productReports", "main", null);
    }

    public function productAmount()
    {
        $model = new ProductModel();

        $dbData = $model->productAmount();

        echo json_encode($dbData);
    }

    public function productsJSON()
    {
        $model = new ProductModel();

        $numberOfRows = $this->request->getOne("numberOfRows");
        $search = $this->request->getOne("search");
        $numberOfPage = $this->request->getOne("numberOfPage");

        $dbData = $model->productsLoadMore($numberOfPage, $numberOfRows, $search);

        echo json_encode($dbData);
    }

    public function productsDropdown()
    {
        $model = new ProductModel();

        $search = $this->request->getOne("id");

        $dbData = $model->productDropdownSearch($search);

        echo json_encode($dbData);
    }

    /**
     * Read one object from table products - get method
     */
    public function details()
    {
        $model = new ProductModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("id = $model->id"));

        echo $this->view("productDetails", "main", $model);
    }

    /**
     * Edit one object from table products - get method
     */
    public function edit()
    {
        $model = new ProductModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("id = $model->id"));

        echo $this->view("productUpdate", "main", $model);
    }

    /**
     * Create one object from table products - get method
     */
    public function create()
    {
        $model = new ProductModel();

        echo $this->view("productCreate", "main", $model);
    }

    /**
     * Delete one object from table products - get method
     */
    public function delete()
    {
        $model = new ProductModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("id = $model->id"));

        echo $this->view("productDelete", "main", $model);
    }

    /**
     * Create one object into table product - post method
     */
    public function createProcess()
    {
        $model = new ProductModel();

        $model->loadData($this->request->all());

        $model->validate();

        if ($model->errors === null) {
            $model->dateCreated = date('Y-m-d');
            $model->dateUpdated = date('Y-m-d');
            $model->id = 0;
            if ($model->active === "on")
                $model->active = true;

            if ($model->create($model)) {
                Application::$app->session->setFlash('success', "Uspesno dodato!");
                Application::$app->response->redirect("/productCreate");
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/productCreate");
    }

    /**
     * Import data from json
     */
    public function importJsonProcess()
    {
        $model = new ProductModel();

        if ($_FILES['importJson']['name'] !== "" and $_FILES['importJson'] !== null) {
            $data = file_get_contents($_FILES['importJson']['tmp_name']);
            $dataDecoded = json_decode($data);

            $errors = $model->createList($dataDecoded);

            if ($errors === null) {
                Application::$app->session->setFlash('success', "Uspesno dodato!");
            } else {
                Application::$app->session->setFlash('jsonErrors', $errors);
            }

            Application::$app->response->redirect("/productCreate");
        } else {
            Application::$app->response->redirect("/productCreate");
        }
    }

    /**
     * Edit one object from table product - post method
     */
    public function editProcess()
    {
        $model = new ProductModel();

        $model->loadData($this->request->all());

        $model->validate();

        if ($model->errors === null) {
            $model->dateUpdated = date('Y-m-d');
            if ($model->active === "on")
                $model->active = true;

            if ($model->updateProduct($model)) {
                Application::$app->session->setFlash('success', "Uspesno promenjeno!");
                Application::$app->response->redirect("/productEdit?id=$model->id");
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/productEdit?id=$model->id");
    }

    /**
     * Delete one object from table product
     */
    public function deleteProcess()
    {
        $model = new ProductModel();

        $model->loadData($this->request->all());

        if ($model->delete("id = $model->id")) {
            Application::$app->session->setFlash('success', "Uspesno obrisano!");
            Application::$app->response->redirect("/products");
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/products");
    }

    public function athorize()
    {
        return [
            "Administrator",
            "SuperAdministrator",
            "Korisnik"
        ];
    }



}