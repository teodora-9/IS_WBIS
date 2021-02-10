<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\CustomerModel;

class CustomerController extends Controller
{
    /**
     * List of all customers - get method
     */
    public function customers()
    {
        $model = new CustomerModel();

        $dbData = $model->customerWithPagination(0, 10, null);

        echo $this->view("customers", "main", $dbData);
    }

    public function reports()
    {
        echo $this->view("customerReports", "main", null);
    }

    public function customersJSON()
    {
        $model = new CustomerModel();

        $numberOfPage = $this->request->getOne("numberOfPage");
        $numberOfRows = $this->request->getOne("numberOfRows");
        $search = $this->request->getOne("search");

        $dbData = $model->customerWithPagination($numberOfPage, $numberOfRows, $search);

        echo json_encode($dbData);
    }

    public function customersPerDay()
    {
        $model = new CustomerModel();

        $dbData = $model->customerPerDay();

        echo json_encode($dbData);
    }

    public function customersActive()
    {
        $model = new CustomerModel();

        $dbData = $model->customerActive();

        echo json_encode($dbData);
    }

    public function totalSalesPerMonth()
    {
        $model = new CustomerModel();

        $dbData = $model->totalSalesPerMonth();

        echo json_encode($dbData);
    }

    public function customersDropdown()
    {
        $model = new CustomerModel();

        $search = $this->request->getOne("id");

        $dbData = $model->customerDropdownSearch($search);

        echo json_encode($dbData);
    }

    /**
     * Read one object from table products - get method
     */
    public function details()
    {
        $model = new CustomerModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("id = $model->id"));

        echo $this->view("customerDetails", "main", $model);
    }

    /**
     * Edit one object from table customers - get method
     */
    public function edit()
    {
        $model = new CustomerModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("id = $model->id"));

        echo $this->view("customerUpdate", "main", $model);
    }

    /**
     * Create one object from table customers - get method
     */
    public function create()
    {
        $model = new CustomerModel();

        echo $this->view("customerCreate", "main", $model);
    }

    /**
     * Delete one object from table customers - get method
     */
    public function delete()
    {
        $model = new CustomerModel();

        $model->loadData($this->request->all());
        $model->loadData($model->one("id = $model->id"));

        echo $this->view("customerDelete", "main", $model);
    }

    /**
     * Create one object into table customer - post method
     */
    public function createProcess()
    {
        $model = new CustomerModel();

        $model->loadData($this->request->all());

        $model->validate();
        echo "<div>";
        echo "nesto";
        echo "</div>";
        $name =$this->request->getOne("name");
        $address =$this->request->getOne("address");
        $number =$this->request->getOne("number");
        $email =$this->request->getOne("email");
        $decription =$this->request->getOne("decription");
        echo "$name, $address, $number, $email, $decription";
        if ($model->errors === null) {
            $model->dateCreated = date('Y-m-d');
            $model->dateUpdated = date('Y-m-d');
            $model->id = 0;
            if ($model->active === "on")
                $model->active = true;
            echo "<pre>";
            var_dump($_REQUEST);
            echo "</pre>";

            if ($model->create($model)) {
                echo "<pre>";
                var_dump($_REQUEST);
                echo "</pre>";

                Application::$app->session->setFlash('success', "Uspesno dodato!");
                Application::$app->response->redirect("/customerCreate");
                echo "<div>";
                echo "nesto4";
                echo "</div>";

            }
        }
        echo "<div>";
        echo "nesto5";
        echo "</div>";

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/customerCreate");
    }

    /**
     * Import Json process
     */
    public function importJsonProcess()
    {
        $model = new CustomerModel();

        if ($_FILES['importJson']['name'] !== "" and $_FILES['importJson'] !== null) {
            $data = file_get_contents($_FILES['importJson']['tmp_name']);
            $dateDecoded = json_decode($data);
            $br = 0;

            foreach ($dateDecoded as $row) {
                $model = new CustomerModel();

                $model->loadData($row);

                $model->validate();

                if ($model->errors === null) {
                    $model->create($model);
                }else {
                    foreach ($model->errors as $attribute => $value) {
                        $errors[$br][$attribute] = $value;
                    }
                }
                $br++;
            }
        }

        if ($model->errors !== null) {
            Application::$app->session->setFlash('success', "Uspesno dodato!");
        }else{
            Application::$app->session->setFlash('jsonErrors', $errors);
        }

        Application::$app->response->redirect("/customerCreate");
    }

    /**
     * Edit one object from table customer - post method
     */
    public function editProcess()
    {
        $model = new CustomerModel();

        $model->loadData($this->request->all());

        $model->validate();

        if ($model->errors === null) {
            $model->dateUpdated = date('Y-m-d');
            if ($model->active === "on")
                $model->active = true;

            if ($model->updateCustomer($model)) {
                Application::$app->session->setFlash('success', "Uspesno promenjeno!");
                Application::$app->response->redirect("/customerEdit?id=$model->id");
            }
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/customerEdit?id=$model->id");
    }

    /**
     * Delete one object from table customer
     */
    public function deleteProcess()
    {
        $model = new CustomerModel();

        $model->loadData($this->request->all());

        if ($model->delete("id = $model->id")) {
            Application::$app->session->setFlash('success', "Uspesno obrisano!");
            Application::$app->response->redirect("/customers");
        }

        Application::$app->session->setFlash('errors', $model->errors);
        Application::$app->response->redirect("/customers");
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