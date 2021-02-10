<?php


namespace app\controllers;


use app\core\Application;
use app\core\Controller;
use app\models\InvoiceModel;

class InvoiceController extends Controller
{
    /**
     * List of all invoices - get method
     */
    public function invoices()
    {
        echo $this->view("invoices", "main", null);
    }

    public function invoicesJSON()
    {
        $model = new InvoiceModel();

        $numberOfRows = $this->request->getOne("numberOfRows");
        $search = $this->request->getOne("search");
        $numberOfPage = $this->request->getOne("numberOfPage");

        $dbData = $model->invoicesLoadMore($numberOfPage, $numberOfRows, $search);

        echo json_encode($dbData);
    }

    /**
     * Read one object from table invoice - get method
     */
    public function details()
    {
        $model = new InvoiceModel();

       $model->loadData($this->request->all());

        echo $this->view("invoiceDetails", "main", $model);
    }

    public function invoicesPerMonth()
    {
        $model = new InvoiceModel();

        $dbData = $model->invoicesPerMonth();

        echo json_encode($dbData);
    }

    public function reports()
    {
        echo $this->view("invoiceReports", "main", null);
    }

    /**
     * Create one object from table invoice - get method
     */
    public function create()
    {
        $model = new InvoiceModel();

        echo $this->view("invoiceCreate", "main", $model);
    }

    /**
     * Create one object into table invoice - post method
     */
    public function createProcess()
    {
        $model = new InvoiceModel();

        $products = $this->request->getOne("productId");
        $quantity = $this->request->getOne("quantity");
        $customerId = $this->request->getOne("customerId");
        $user = Application::$app->session->getAuth('user');

        if ($model->createFullInvoice($user->id, $customerId, $products, $quantity)){
            Application::$app->session->setFlash('success', "Uspesno dodato!");
            Application::$app->response->redirect("/invoiceCreate");
            exit;
        }

        Application::$app->session->setFlash('errors', "Greska! Neka polja nisu validna");
        Application::$app->response->redirect("/invoiceCreate");
        exit;
    }

    /**
     * Edit one object from table invoice - post method
     */
    public function editProcess()
    {
        $model = new InvoiceModel();

        $model->loadData($this->request->all());

        $model->validate();

        if (!isset($model->errors)){
            $model->edit($model);

            $model->success = "Uspesno dodato!";
        }

        echo $this->view("invoiceEdit", "main", $model);
    }

    /**
     * Delete one object from table invoice
     */
    public function deleteProcess()
    {
        $model = new InvoiceModel();

        $model->loadData($this->request->all());

        $model->delete($model);

        header("location:" . "/invoice");

        exit;
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