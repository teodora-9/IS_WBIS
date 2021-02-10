<?php
use app\core\Application;

/** @var $params \app\models\UserRolesModel
 */


$errors = Application::$app->session->getFlash('errors');

if ($errors !== false)
{
    $params->errors = $errors;
}
?>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Edit user role</h3>
                </div>
                <?php echo  \app\core\Form::beginForm("userRoleUpdateProcess", "post")?>
                <?php echo "<div class='card-body'>" ?>
                <div class="row">
                    <div class="col-md-6 border-right">
                        <?php
                        //$currentRole = $params->roleName($params->idRole);
                        //var_dump($params);
                        echo "<input type='hidden' name='id' value='$params->id'>";


                        echo "<h5>Current Role:</h5>";
                        echo  "<h3><b>";
                        $params->roleName($params->idRole);
                        echo "</b></h3><br><br>";
                        ?>

                        <div class="form-group">
                            <?php //echo  \app\core\Form::field($params, 'idRole', 'text');

                            //$currentRole = $params->roleName($params->idRole);
                            $params->selectRole($params->idRole);
                            ?>
                        </div>
                    </div>
                </div>
                <?php echo "</div>" ?>
                <?php echo "<div class='card-footer'>" ?>
                <?php echo sprintf("<a href='/positions' style='text-decoration: none; color: white;' class='btn btn-info'>Go back to list</a>")?>
                <?php echo sprintf("<button type='submit' class='btn btn-primary'>Submit</button>")?>
                <?php echo "</div>" ?>
                <?php echo  \app\core\Form::endForm()?>
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>

<?php

$success = Application::$app->session->getFlash('success');

if ($success !== false)
{
    echo "
        <script>
            $(document).ready(function (){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });


                Toast.fire({
                    icon: 'success',
                    title: '$success'
                })
            });
        </script>
        ";
}
?>