<?php


namespace app\models;


use app\core\DBModel;

class RolesModel extends DBModel
{
    public $id;
    public $roleName;
    public $active;

    public function tableName()
    {
        return "roles";
    }

    public function attributes(): array
    {
        return [
            'roleName',
            'active'
        ];
    }

    public function rules(): array
    {
        // TODO: Implement rules() method.
    }

    public function labels(): array
    {
        return [
            'roleName' => "Role Name",
            'active' => "Active"
        ];
    }
}