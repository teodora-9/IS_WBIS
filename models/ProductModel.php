<?php


namespace app\models;


use app\core\DBModel;

class ProductModel extends DBModel
{
    public $id = '';
    public $dateCreated = '';
    public $dateUpdated = '';
    public $name = '';
    public $unit = '';
    public $price = '';
    public $description = '';
    public $active = '';

    public function tableName()
    {
        return 'products';
    }

    public function attributes(): array
    {
        return [
            'id',
            'dateCreated',
            'dateUpdated',
            'name',
            'unit',
            'price',
            'description',
            'active'
        ];
    }

    public function rules(): array
    {
        return [
            'name' => [self::RULE_REQUIRED],
            'unit' => [self::RULE_REQUIRED],
            'price' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'name' => "Name",
            'unit' => "Unit",
            'price' => "Price",
            'description' => "Description",
            'active' => "Active"
        ];
    }

    public function updateProduct(ProductModel $model)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "UPDATE products SET 
                    `dateUpdated` = '$model->dateUpdated',
                    `name` = '$model->name', 
                    `unit` = '$model->unit', 
                    `price` = $model->price, 
                    `description` = '$model->description', 
                    `active` = '$model->active' 
                    WHERE `id` = $model->id;";

        $db->query($sqlString) or die();

        return true;
    }

    public function createList($array)
    {
        $errors = [];
        $br = 0;
        $db = $this->dbConnection->conn();
        $modelHelp = new ProductModel();
        $sqlString = "INSERT INTO products ( `dateCreated`, `dateUpdated`, `name`,`unit`,`price`,`description`, `active`) VALUES ";

        $numberOfRows = count($array);

        foreach ($array as $item) {
            $model = new ProductModel();

            $model->loadData($item);
            $model->validate();

            if ($model->errors !== null) {
                foreach ($model->errors as $attribute => $value) {
                    $errors[$br][$attribute] = $value;
                }
            }

            $sqlString = $sqlString . "('$model->dateCreated', '$model->dateUpdated', '$model->name', '$model->unit', '$model->price', '$model->description', '$model->active'),";

            $br++;
        }

        $sqlString = substr_replace($sqlString ,";",-1);
        $db->query($sqlString) or die();

        return $errors;
    }

    public function productsLoadMore($numberOfPage, $numberOfRows, $search)
    {
        $db = $this->dbConnection->conn();

        if ($search !== null and $search !== ""){
            $sqlString = "select * from `products` where `name` like '%$search%' LIMIT $numberOfRows";
        }else
        {
            $startOn = $numberOfPage * $numberOfRows;
            $sqlString = "select * from `products` where `name` like '%$search%' LIMIT $startOn, $numberOfRows";
        }

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }

    public function productDropdownSearch($search)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "select `id`, `name`, `price` from products where `name` like '%$search%' LIMIT 10";
        $dataResult = $db->query($sqlString) or die();

        $data = array();
        while ($row = mysqli_fetch_array($dataResult)) {
            $data[] = array("id"=>$row['id'], "text"=>$row['name'] . " (" . $row['price'] . " €)");
        }

        return $data;
    }

    public function productAmount()
    {
        $db = $this->dbConnection->conn();

        $sqlString = "select invoicesystem.products.name, invoicesystem.products.unit from invoicesystem.products where invoicesystem.products.active = 1";

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }
}