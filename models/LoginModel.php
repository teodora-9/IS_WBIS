<?php


namespace app\models;


use app\core\DBModel;

class LoginModel extends DBModel
{
    public string $email = '';
    public string $password = '';

    public function tableName()
    {
        return "users";
    }

    public function attributes(): array
    {
        return [
            'email',
            'password'
        ];
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array
    {
        return [
            'email' => "Email",
            'password' => "Password"
        ];
    }

    public function login(LoginModel $model)
    {
        $modelDB = new LoginModel();

        $modelDB->loadData($model->one("email = '$model->email';"));

        if ($modelDB !== null)
        {
            if (password_verify($model->password, $modelDB->password)){
                return true;
            }
        }

        return false;
    }
}