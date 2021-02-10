<?php


namespace app\models;


use app\core\DBModel;
use app\core\Model;

class RegisterModel extends DBModel
{
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    public bool $active = false;

    public function rules(): array
    {
        return [
            'email' => [self::RULE_EMAIL, self::RULE_REQUIRED, self::RULE_EMAIL_UNIQUE],
            'password' => [self::RULE_REQUIRED],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }

    /**
     * @return table name
     */
    public function tableName()
    {
        return 'users';
    }

    public function attributes(): array
    {
        return [
            'email',
            'password',
            'active'
        ];
    }

    public function register(RegisterModel $model)
    {
        $model->password = password_hash($model->password, PASSWORD_DEFAULT);
        $model->active = true;

        $model->create();
        $userModel = new UserModel();

        $user = $userModel->one("email = '$model->email';");
        $userModel->loadData($user);

        $rolesModel = new RolesModel();
        $rolesModel->roleName = "Korisnik";
        $role = $rolesModel->one("roleName = '$rolesModel->roleName' and active = true;");
        $rolesModel->loadData($role);

        $userRolesModel = new UserRolesModel();

        $userRolesModel->idRole = $rolesModel->id;
        $userRolesModel->idUser = $userModel->id;

        $userRolesModel->create();

        return true;
    }

    public function labels(): array
    {
        return [
            'email' => "Email",
            'password' => "Password",
            'confirmPassword' => "Confirm Password"
        ];
    }
}