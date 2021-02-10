<?php


namespace app\models;


use app\core\DBModel;

class CustomerModel extends DBModel
{
    public $id = '';
    public $dateCreated = '';
    public $dateUpdated = '';
    public $name = '';
    public $address = '';
    public $email = '';
    public $number = '';
    public $description = '';
    public $active = '';

    public function tableName()
    {
        return 'customers';
    }

    public function attributes(): array
    {
        return [
            'id',
            'dateCreated',
            'dateUpdated',
            'name',
            'address',
            'email',
            'number',
            'description',
            'active'
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'name' => 'Name',
            'address' => 'Address',
            'email' => 'Email',
            'number' => 'Number',
            'decription' => 'Description',
            'active' => 'Active'
        ];
    }

    public function updateCustomer(CustomerModel $model)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "UPDATE customers SET 
                    /*`dateUpdated` = '$model->dateUpdated',*/
                    `name` = '$model->name', 
                    `address` = '$model->address', 
                    `email` = '$model->email', 
                    `number` = '$model->number', 
                    `description` = '$model->description', 
                    `active` = '$model->active' 
                    WHERE `id` = $model->id;";

        $db->query($sqlString) or die();

        return true;
    }

    public function customerWithPagination($numberOfPage, $numberOfRows, $search)
    {
        $db = $this->dbConnection->conn();

        if ($search !== null and $search !== "") {
            $sqlString = "select * from customers where `name` like '%$search%' LIMIT $numberOfRows";
        } else {
            $startOn = $numberOfPage * $numberOfRows;
            $sqlString = "select * from customers LIMIT $startOn, $numberOfRows";
        }

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function customerDropdownSearch($search)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "select `id`, `name`, `email` from customers where `name` like '%$search%' LIMIT 10";
        $dataResult = $db->query($sqlString) or die();

        $data = array();
        while ($row = mysqli_fetch_array($dataResult)) {
            $data[] = array("id" => $row['id'], "text" => $row['name'] . " (" . $row['email'] . ")");
        }

        return $data;
    }

    public function customerPerDay()
    {
        $db = $this->dbConnection->conn();

        $sqlString = "SELECT `dateCreated`, count(id) as 'numberOfCustomers' FROM `customers` WHERE `dateCreated` BETWEEN (NOW() - INTERVAL 1 MONTH) AND NOW() group by `dateCreated`";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function customerActive()
    {
        $db = $this->dbConnection->conn();

        $sqlString = "select case when active = 1 then 'Aktivan' else 'Neaktivan' end as 'active', count(id) as 'numberOfCustomers' from customers group by active";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function totalSalesPerMonth()
    {
        $db = $this->dbConnection->conn();

        $sqlString = "SELECT monthname(dateCreated) AS 'month', sum(total) as 'totalSum' FROM invoices group by year(dateCreated),month(dateCreated)";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }
}