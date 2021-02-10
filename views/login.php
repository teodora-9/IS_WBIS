<?php
use app\core\Application;

/** @var $params \app\models\LoginModel
 */

$errors = Application::$app->session->getFlash('errors');

if ($errors !== false)
{
    $params->errors = $errors;
}
?>


<p class="login-box-msg">Login</p>
    <?php echo \app\core\Form::beginForm('loginProcess', 'post') ?>
        <div class="form-group">
            <?php echo \app\core\Form::field($params, 'email', 'email')?>
        </div>
        <div class="form-group">
            <?php echo \app\core\Form::field($params, 'password', 'password')?>
        </div>
        <div class="form-group">
            <?php echo "<button class='btn btn-lg btn-primary btn-block' type='submit'>Log in</button>"?>
        </div>
    <?php echo \app\core\Form::endForm() ?>
    <a href="/register" class="text-center">Create new account</a>

<?php


$error = Application::$app->session->getFlash('errorUser');

if ($error  !== false) {
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
                    icon: 'error',
                    title: '$error'
                })
            });
        </script>
        ";
}

