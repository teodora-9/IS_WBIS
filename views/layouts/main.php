<?php
use app\core\Application;

/** @var $params \app\models\UserModel
 */

$user = Application::$app->session->getAuth('user');

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>GameStore IS</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="assets/plugins/select2/css/select2.bundle.css">
    <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <style type="text/css">/* Chart.js */
        @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/home" class="brand-link">
            <img src="assets/dist/img/invoicePNG.png" alt="Invoice Logo" class="brand-image elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">GameStore IS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="assets/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="/profile" class="d-block">
                        <?php echo $user->firstName . " " . $user->lastName?>
                    </a>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="/home" class="nav-link">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Home
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Profile
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/positions" class="nav-link">
                            <i class="nav-icon fas fa-user-plus"></i>
                            <p>
                                Position
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/invoices" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Invoices
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/products" class="nav-link">
                            <i class="nav-icon fas fa-warehouse"></i>
                            <p>
                                Products
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/customers" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Customers
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Reports
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/customerReports" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Customers
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/productReports" class="nav-link">
                                    <i class="nav-icon fas fa-warehouse"></i>
                                    <p>
                                        Products
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/invoiceReports" class="nav-link">
                                    <i class="nav-icon fas fa-file-invoice"></i>
                                    <p>
                                        Invoices
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="/logout" class="nav-link">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>
                                Sign out
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Select2 -->
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <!-- ChartJS -->
    <script src="assets/plugins/chart.js/Chart.min.js"></script>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">&nbsp;</div>
                {{ renderSection }}
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->


</body>
</html>
