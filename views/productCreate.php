<?php
use app\core\Application;

/** @var $params \app\models\ProductModel
 */


$errors = Application::$app->session->getFlash('errors');

if ($errors !== false) {
    $params->errors = $errors;
}

$jsonErrors = Application::$app->session->getFlash('jsonErrors');

if ($jsonErrors !== false) {
    $params->errors = $jsonErrors;

echo '<div class="row">';
    echo '<div class="col-md-12">';
        echo '<div class="card card-default">';
            echo '<div class="card-header">';
                echo '<h3>Errors</h3>';
            echo '</div>';
            echo' <div class="card-body" style="color: red;">';
                    foreach ($params->errors as $objectNum => $item){
                        foreach ($item as $propertyName => $values){
                            foreach ($values as $message){
                                echo $objectNum . "->" . $propertyName . "->" . $message . "<br>";
                            }
                        }
                    }
            echo '</div>';
         echo '</div>';
    echo '</div>';
echo '</div>';
}
?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <div class="card-title">
                    <h3 class="card-title">Create product</h3>
                </div>
                <div class="card-tools">
                    <form action="importProductJsonProcess" method="post" enctype="multipart/form-data">
                        <input type="file" name="importJson" id="importJson" accept="application/json">
                        <button type="submit" class="btn btn-primary">Submit JSON</button>
                    </form>
                </div>
            </div>
            <?php echo  \app\core\Form::beginForm("productCreateProcess", "post")?>
            <?php echo "<div class='card-body'>" ?>
            <div class="row">
                <div class="col-md-6 border-right">
                    <div class="form-group">
                        <?php echo  \app\core\Form::field($params, 'name', 'text')?>
                    </div>
                    <div class="form-group">
                        <?php echo  \app\core\Form::field($params, 'unit', 'text')?>
                    </div>
                    <div class="form-group">
                        <?php echo  \app\core\Form::field($params, 'price', 'text')?></div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Description ..."></textarea>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" name="active" id="active" class="form-check-input">
                        <label for="active">Active</label>
                    </div>
                </div>
            </div>
            <?php echo "</div>" ?>
            <?php echo "<div class='card-footer'>" ?>
            <?php echo sprintf("<a href='/products' style='text-decoration: none; color: white;' class='btn btn-info'>Go back to list</a>")?>
            <?php echo sprintf("<button type='submit' class='btn btn-primary'>Submit</button>")?>
            <?php echo "</div>" ?>
            <?php echo  \app\core\Form::endForm()?>
        </div>
    </div>
    <div class="col-md-6">
    </div>
</div>

<div></div>

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

<?php

$errors = Application::$app->session->getFlash('errors');

if ($errors  !== false)
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
                    icon: 'error',
                    title: 'Nisu sva polja uspesno uneta!'
                })
            });
        </script>
        ";
}
?>


