<?php


namespace app\models;


use app\core\DBModel;

class UserRolesModel extends DBModel
{
    public $id;
    public $idRole;
    public $idUser;
    public $roleName;


    public function tableName()
    {
        return "user_roles";
    }

    public function attributes(): array
    {
        return [
            'idRole',
            'idUser'
        ];
    }

    public function rules(): array
    {
        return [
        ];
        // TODO: Implement rules() method.
    }

    public function labels(): array
    {
        return [
            'idRole' => "Role ID",
            'idUser' => "User ID"
        ];
    }

    public function roleName($idRole){
        $db = $this->dbConnection->conn();


        $sqlString = "select r.roleName as role from roles r where r.id = $idRole";


        $dataResult = $db->query($sqlString) or die();

        if ($dataResult->num_rows > 0) {
            // output data of each row
            while ($row = $dataResult->fetch_assoc()) {
                echo $row["role"];
            }
        }
    }

    public function selectRole($idRole){
        $db = $this->dbConnection->conn();


        $sqlString = "select r.roleName as role, r.id from roles r";

        $dataResult = $db->query($sqlString) or die();

        if ($dataResult->num_rows > 0) {
            // output data of each row
            echo "<select class='form-control' name = 'idRole'>";
            while ($row = $dataResult->fetch_assoc()) {
                $temp = $row["role"];
                $temp2 = $row["id"];
                if($idRole == $row["id"]){
                    echo "<option value='$temp2' name='$idRole' selected>$temp</option>";
                }
                else{
                    echo "<option value='$temp2'name='$idRole'>$temp</option>";
                }


            }
            echo "</select>";
        }

    }

    public function updateRole(UserRolesModel $model)
    {
        $db = $this->dbConnection->conn();

        $sqlString = "UPDATE user_roles SET 
                    idRole = '$model->idRole'
                    WHERE idUser = $model->id;";

        $db->query($sqlString) or die();

        return true;
    }
}