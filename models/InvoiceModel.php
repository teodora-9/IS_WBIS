<?php


namespace app\models;

use app\core\DBModel;
use app\core\Model;

class InvoiceModel extends DBModel
{
    public $id;
    public $dateCreated;
    public $dateUpdated;
    public $firstName;
    public $lastName;
    public $name;
    public $active;
    public $email;
    public $quantity;
    public $product;

    public function rules(): array
    {
        return [
            'customer_name' => [self::RULE_REQUIRED],
            'product' => [self::RULE_REQUIRED],
            'quantity' => [self::RULE_REQUIRED]
        ];
    }

    public function tableName()
    {
        return 'invoice';
    }

    public function labels(): array
    {
        return [
            "id" => "Id",
            "customer_name" => "Customer name",
            "product" => "Product",
            "quantity" => "Quantity"
        ];
    }

    public function invoicesLoadMore($numberOfPage, $numberOfRows, $search)
    {
        $db = $this->dbConnection->conn();

        if ($search !== null and $search !== "") {
            $sqlString = "
                select  inv.id, 
                        inv.dateCreated, 
                        inv.dateUpdated,
                        inv.total,
                        u.firstName, 
                        u.lastName, 
                        c.name,
                        inv.active
                from invoices inv
                inner join users u on inv.idUser = u.id
                inner join customers c on inv.idCustomer = c.id
                where c.name like '%$search%' or inv.id like '%$search%' LIMIT $numberOfRows";
        } else {
            $startOn = $numberOfPage * $numberOfRows;
            $sqlString = "
                select  inv.id, 
                        inv.dateCreated, 
                        inv.dateUpdated,
                        inv.total,
                        u.firstName, 
                        u.lastName, 
                        c.name,
                        inv.active
                from invoices inv
                inner join users u on inv.idUser = u.id
                inner join customers c on inv.idCustomer = c.id
                where c.name like '%$search%' or inv.id like '%$search%' LIMIT $startOn, $numberOfRows";
        }

        $dbData = $db->query($sqlString) or die($db->error);

        $resultArray = [];

        while ($result = $dbData->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function createMultipleInvoiceItem($products, $quantity, $invoiceId)
    {
        $db = $this->dbConnection->conn();
        $currentDate = date('Y-m-d');
        $active = true;

        $sqlString = "INSERT INTO invoice_items (`dateCreated`, `dateUpdated`, `idProduct`, `quantity`, `idInvoice`, `active`) VALUES ";

        for ($i = 0; $i < count($products); ++$i) {
            if (isset($products[$i]) and $products[$i] !== 0 and $products[$i] !== null and $products[$i] !== "" and $products[$i] !== "0" and $quantity[$i] !== ''){
                $sqlString = $sqlString . "('$currentDate', '$currentDate', '$products[$i]', '$quantity[$i]', '$invoiceId', '$active'),";
            }
        }

        $sqlString = substr_replace($sqlString, ";", -1);

        $db->query($sqlString) or die();

        return true;
    }

    public function createInvoice($userId, $customerId, $products, $quantity)
    {
        $db = $this->dbConnection->conn();
        $currentDate = date('Y-m-d');
        $active = true;
        $total = 0;
        $productModel = new ProductModel();

        for ($i = 0; $i < count($products); ++$i) {
            if (isset($products[$i]) and $products[$i] !== 0 and $products[$i] !== null and $products[$i] !== "" and $products[$i] !== "0" and $quantity[$i] !== ''){
                $productModel->loadData($productModel->one("id= $products[$i]"));

                $total = $total + ($productModel->price * $quantity[$i]);
            }
        }

        $sqlString = "INSERT INTO invoices (`dateCreated`, `dateUpdated`, `idUser`, `idCustomer`, `total`, `active`) VALUES ('$currentDate', '$currentDate', '$userId', '$customerId', '$total', '$active')";

        $db->query($sqlString) or die();

        return true;
    }

    public function lastAddedInvoice(){
        $db = $this->dbConnection->conn();

        $sqlString = "SELECT id FROM invoices ORDER BY id DESC LIMIT 1";

        $dbData = $db->query($sqlString) or die();

        $lastAddedInvoice = $dbData->fetch_assoc();

        return intval($lastAddedInvoice['id']);
    }

    public function createFullInvoice($userId, $customerId, $products, $quantity)
    {
        if (!$this->createInvoice($userId, $customerId, $products, $quantity))
            return false;

        $invoiceId = $this->lastAddedInvoice();

        $result = $this->createMultipleInvoiceItem($products, $quantity, $invoiceId);

        return $result;
    }

    public function attributes(): array
    {
        // TODO: Implement attributes() method.
    }

    public function readOne($id){

        $db = $this->dbConnection->conn();

        $sqlString = "Select invoices.id, invoices.dateCreated, invoices.dateUpdated, invoices.total, products.name,products.price , invoice_items.quantity, customers.email  
from invoice_items
 inner join products on products.id = invoice_items.idProduct
 inner join invoices on invoices.id = invoice_items.idInvoice
 inner join customers on customers.id = invoices.idCustomer
 where invoices.id = $id";


        $dataResult = $db->query($sqlString) or die();


        if ($dataResult->num_rows > 0) {

            // output data of each row
            //while ($row = $dataResult->fetch_assoc()) {
            $row = $dataResult->fetch_assoc();
            echo "<h2><b>Invoice details:</b></h2>";
                //echo "<h3><b>Id: </b>" . $row["id"] . "</h3>";
                echo "<h3><b>Date Created: </b>" . $row["dateCreated"] . "</h3>";
                echo "<h3><b>Date Updated: </b>" . $row["dateUpdated"] . "</h3>";
                echo "<h3><b>Total amount: </b>" . $row["total"] . "(€)</h3>";
                echo "<h3><b>Email: </b>" . $row["email"] . "</h3>";

            }
        }


    public function readTwo($id){

        $db = $this->dbConnection->conn();

        $sqlString = "Select invoices.id, invoices.dateCreated, invoices.dateUpdated, invoices.total, products.name,products.price , invoice_items.quantity, customers.email  
            from invoice_items
             inner join products on products.id = invoice_items.idProduct
             inner join invoices on invoices.id = invoice_items.idInvoice
             inner join customers on customers.id = invoices.idCustomer
             where invoices.id = $id";


        $dataResult = $db->query($sqlString) or die();

        $table = '<table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info"><tr><th>Quantity</th><th>Name</th><th>Price(€)</th></tr>';

        if ($dataResult->num_rows > 0) {

            // output data of each row
            while ($row = $dataResult->fetch_assoc()) {

                $table .= "<tr>";
                $table .= "<td>{$row['quantity']}</td>";
                $table .= "<td>{$row['name']}</td>";
                $table .= "<td>{$row['price']}</td>";
                $table .= "</tr>";

            }

            $table .= "</table>";
            print $table;
        }
    }
    public function invoicesPerMonth()
    {
        $db = $this->dbConnection->conn();

        $sqlString = "SELECT monthname(dateCreated) AS 'month', count(id) as 'numberOfInvoices' FROM invoices 
        group by dateCreated";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

}