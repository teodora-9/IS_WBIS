<?php


namespace app\models;


use app\core\DBModel;

class PositionModel extends DBModel
{
    public $id = '';
    public $email = '';
    public $password = '';
    public $firstName = '';
    public $lastName = '';
    public $role = '';
    public $active = '';

    public function tableName()
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'id',
            'email',
            'password',
            'firstName',
            'lastName',
            'status',
            'role'
        ];
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED],
        ];
    }

    public function labels(): array
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'firstName' => 'FirstName',
            'lastName' => 'LastName',
            'active' => 'Active',
            'role' => 'Role'
        ];
        // TODO: Implement labels() method.
    }

    public function updatePosition(PositionModel $model)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "UPDATE users SET 
                    email = '$model->email', 
                    password = '$model->password', 
                    firstName = '$model->firstName', 
                    lastName = '$model->lastName',
                    active = '$model->active' 
                    WHERE id = $model->id;";

        $db->query($sqlString) or die();

        return true;
    }


    public function positionWithPagination($numberOfPage, $numberOfRows, $search)
    {
        $db = $this->dbConnection->conn();

        if ($search !== null and $search !== "") {
            $sqlString = "select u.id, u.email, u.firstName, u.lastName, r.roleName as role from users u
            inner join user_roles ur on u.id = ur.idUser inner join roles r on r.id = ur.idRole where `email` like '%$search%' LIMIT $numberOfRows";
        } else {
            $startOn = $numberOfPage * $numberOfRows;
            $sqlString = "select u.id, u.email, u.firstName, u.lastName, r.roleName as role from users u
            inner join user_roles ur on u.id = ur.idUser inner join roles r on r.id = ur.idRole
            LIMIT $startOn, $numberOfRows";
        }

        $dataResult = $db->query($sqlString) or die();

        $resultArray = [];

        while ($result = $dataResult->fetch_assoc()) {
            array_push($resultArray, $result);
        }

        return $resultArray;
    }


    public function positionDropdownSearch($search)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "select `id`, `email`,`firstName` from users where `firstName` like '%$search%' LIMIT 10";
        $dataResult = $db->query($sqlString) or die();

        $data = array();
        while ($row = mysqli_fetch_array($dataResult)) {
            $data[] = array("id" => $row['id'], "text" => $row['email'] . " (" . $row['firstName'] . ")");
        }

        return $data;
    }

}