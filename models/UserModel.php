<?php


namespace app\models;


use app\core\DBModel;

class UserModel extends DBModel
{
    public $id;
    public $email;
    public $firstName;
    public $lastName;
    public $roleName;
    public $active;

    public function tableName()
    {
        return "users";
    }

    public function attributes(): array
    {
        return [
            'id',
            'email',
            'password',
            'firstName',
            'lastName',
            'status'
        ];
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED, self::RULE_EMAIL_UNIQUE]
        ];
    }

    public function labels(): array
    {
        // TODO: Implement labels() method.
    }

    public function readAllUserData($email)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "select 	
                        u.id, 
                        u.email, 
                        u.firstName, 
                        u.lastName, 
                        r.roleName 
                from users u
                inner join user_roles ur on u.id = ur.idUser
                inner join roles r on r.id = ur.idRole
                where email ='$email'";

        $dataResult = $db->query($sqlString) or die();

        $result = $dataResult->fetch_assoc();

        return $result;
    }

    public function updateUser(UserModel $model)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "UPDATE users SET `firstName` = '$model->firstName', `lastName` = '$model->lastName' WHERE id='$model->id'";

        $db->query($sqlString) or die();

        return true;
    }

}