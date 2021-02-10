<?php
    use app\core\Application;

    /** @var $params \app\models\UserModel
     */

    $errors = Application::$app->session->getFlash('errors');

    if ($errors !== false)
    {
        $params->errors = $errors;
    }
?>

<div class="row">
    <div class="col-md-3">
        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <img class="profile-user-img img-fluid img-circle" src="assets/dist/img/avatar5.png" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">
                    <?php
                        echo $params->firstName . " " . $params->lastName;
                    ?>
                </h3>

                <p class="text-muted text-center">
                    <?php
                        echo $params->roleName;
                    ?>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <h3>Settings</h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active" id="settings">
                        <form action="/profileUpdate" method="post" class="form-horizontal">
                            <input type="hidden" name="id" value="<?php echo $params->id?>">
                            <div class="form-group row">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="email" value="<?php echo $params->email?>">
                                    <h3><?php echo $params->email?></h3>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="firstName" class="col-sm-2 col-form-label">First Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="firstName" class="form-control" id="firstName" value="<?php echo $params->firstName?>" placeholder="First Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="lastName" class="col-sm-2 col-form-label">Last Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="lastName" class="form-control" id="lastName" value="<?php echo $params->lastName?>" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
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