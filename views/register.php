<?php
use app\core\Application;

/** @var $params \app\models\RegisterModel
 */

$errors = Application::$app->session->getFlash('errors');

if ($errors !== false)
{
    $params->errors = $errors;
}
?>


<p class="login-box-msg">Register a new membership</p>
<?php echo \app\core\Form::beginForm('registerProcess', 'post') ?>
    <div class="form-group">
        <?php echo \app\core\Form::field($params, 'email', 'email')?>
    </div>
    <div class="form-group">
        <?php echo \app\core\Form::field($params, 'password', 'password')?>
    </div>
    <div class="form-group">
        <?php echo \app\core\Form::field($params, 'confirmPassword', 'password')?>
    </div>
    <div class="form-group">
        <?php echo "<button class='btn btn-lg btn-primary btn-block' type='submit'>Sign in</button>"?>
    </div>
<?php echo \app\core\Form::endForm() ?>
<a href="/login" class="text-center">I already have a membership</a>

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


