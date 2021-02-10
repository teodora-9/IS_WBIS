<?php
use app\core\Application;
?>

<form action="/invoiceCreateProcess" method="post">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Customer information</h3>
                </div>
                <div class="card-body">
                    <select name="customerId" id="customerId" class="form-group col-md-12"></select>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="card-title">Product information</h3>
                    </div>
                    <div class="card-tools">
                        <button class="btn btn-sm btn-primary" type="button" id="btnProductClone"><span class="fa fa-clone"></span> &nbsp; Add product</button>
                    </div>
                </div>
                <div class="card-body" id="productCard">
                    <div class="form-group row productContainer productInput" id="productContainer_0">
                        <div class="col-md-6">
                            <select name="productId[0]" id="productId[0]" class="col-md-12 productDropdown productInput"></select>
                        </div>
                        <div class="col-md-5">
                            <input type="number" name="quantity[0]" id="quantity[0]" placeholder="Quantity" class="form-control productInput">
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-default btnProductDelete" type="button"><span class="fa fa-trash-alt"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card card-default col-md-12">
            <div class="card-header">
                <div class="card-title">
                    &nbsp;
                </div>

                <div class="card-tools">

                    <button type="submit" class="btn btn-success">Submit</button>
                    <?php echo "<div class='card-footer'>" ?>
                    <?php echo sprintf("<a href='/invoices' style='text-decoration: none; color: white;' class='btn btn-info'>Go back to list</a>")?>
                    <?php echo "</div>" ?>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- WBISFrameworkScripts -->
<script src="assets/dist/js/WBISFrameworkScripts.js"></script>

<script>
    $(document).ready(function (){
        $("#customerId").select2({
            placeholder: "Customer...",
            minimumInputLength: 3,
            multiple: false,
            ajax: {
                type: "GET",
                url: "/customersDropdown",
                delay: 250,
                dataType: 'json',
                data: function (params) {
                    var query = {
                        id: params.term
                    }
                    return query;
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
            }
        });

        $(".productDropdown").select2({
            placeholder: "Product...",
            minimumInputLength: 2,
            multiple: false,
            ajax: {
                type: "GET",
                url: "/productsDropdown",
                delay: 250,
                dataType: 'json',
                data: function (params) {
                    var query = {
                        id: params.term
                    }
                    return query;
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
            }
        });

        //Clone track container
        $("#btnProductClone").click(function () {
            //Destroy select2 before cloning
            $('.productDropdown').select2("destroy");

            //Clone
            $("#productContainer_0").clone(true).removeAttr("id").insertAfter("#productContainer_0");

            //Replace name, id,...with real one
            replaceName($(".productContainer"), 'productInput');

            //Select2 ajax call for products
            $(".productDropdown").select2({
                placeholder: "Product...",
                minimumInputLength: 2,
                multiple: false,
                ajax: {
                    type: "GET",
                    url: "/productsDropdown",
                    delay: 250,
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            id: params.term
                        }
                        return query;
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                }
            });
        });


        //Delete track container
        $(".btnProductDelete").click(function () {
            //Destroy select2 before deleting
            $('.productDropdown').select2("destroy");

            //Remove or clear
            if ($(this).closest(".productContainer").attr('id') == "productContainer_0") {
                clear_form_elements("productContainer_0");
            } else {
                $(this).closest(".productContainer").remove();
            }

            //Replace name, id,...with real one
            replaceName($(".productContainer"), 'productInput');

            //Select2 ajax call for products
            $(".productDropdown").select2({
                placeholder: "Product...",
                minimumInputLength: 2,
                multiple: false,
                ajax: {
                    type: "GET",
                    url: "/productsDropdown",
                    delay: 250,
                    dataType: 'json',
                    data: function (params) {
                        var query = {
                            id: params.term
                        }
                        return query;
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                }
            });
        });

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
            echo "
                    Toast.fire({
                        icon: 'success',
                        title: '$success'
                    });
                ";
        }
        ?>

        <?php
        $errors = Application::$app->session->getFlash('errors');
        if ($errors !== false)
        {
            echo "
                    Toast.fire({
                        icon: 'error',
                        title: '$errors'
                    });
                ";
        }
        ?>
    });
</script>





