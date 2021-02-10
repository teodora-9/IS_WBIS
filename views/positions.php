<?php
use app\core\Application;
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h3>User list</h3>
                </div>

            </div>
            <div class="card-header">
                <div class="card-title">
                    <select name="numberOfRows" id="numberOfRows" class="form-group">
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="card-tools">
                    <input type="text" name="search" id="search" class="form-group" placeholder="Search...">
                </div>
            </div>
            <div class="card-body">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-condensed">
                            <tbody id="tableBody">
                            <tr>
                                <th class="border-top-0 text-center">Email</th>
                                <th class="border-top-0 text-center">First name</th>
                                <th class="border-top-0 text-center">Last name</th>
                                <th class="border-top-0 text-center">Role</th>
                                <th class="border-top-0 text-center">Actions</th>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan='5'>
                                    <button type="button" class="btn btn-primary col-md-12" id="loadMoreBtn">
                                        Load more
                                        <span>&nbsp;&nbsp;&nbsp;</span>
                                        <span class="spinner-border spinner-border-sm" role="status" id="progress" style="display:none !important;"></span>
                                    </button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<!-- WBISFrameworkScripts -->
<script src="assets/dist/js/WBISFW.js"></script>

<script>
    $(document).ready(function (){
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        <?php
        $success = Application::$app->session->getFlash('success');

        if ($success !== false)
        {
            echo "Toast.fire({
                        icon: 'success',
                        title: '$success'
                    });";
        }
        ?>

        var url = "/positionsJSON";
        var numberOfPage = 0;
        var numberOfRows = $("#numberOfRows").val();
        var search = $("#search").val();
        var moreData = true;

        loadMorePositionData($("#tableBody"), $("#progress"), $("#loadMoreBtn"), url, numberOfPage, numberOfRows, search);
        numberOfPage++;

        $("#numberOfRows").change(function () {
            search = $("#search").val();
            numberOfRows = $("#numberOfRows").val();
            numberOfPage = 0;

            $("#loadMoreBtn").html("Load more");
            $("#loadMoreBtn").prop('disabled', false);

            $("#tableBody").empty();
            loadMorePositionData($("#tableBody"), $("#progress"), $("#loadMoreBtn"), url, numberOfPage, numberOfRows, search);
        });

        $("#search").change(function () {
            search = $("#search").val();
            numberOfRows = $("#numberOfRows").val();
            numberOfPage = 0;

            $("#loadMoreBtn").html("Load more");
            $("#loadMoreBtn").prop('disabled', false);

            $("#tableBody").empty();
            loadMorePositionData($("#tableBody"), $("#progress"), $("#loadMoreBtn"), url, numberOfPage, numberOfRows, search);
        });

        $("#loadMoreBtn").click(function (){
            loadMorePositionData($("#tableBody"), $("#progress"), $("#loadMoreBtn"), url, numberOfPage, numberOfRows, search);
            numberOfPage++;
        });
    });
</script>