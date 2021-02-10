<?php
use app\core\Application;

/** @var $params \app\models\ProductModel
 */

?>

<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <h1>Are you sure?</h1>
            <?php echo sprintf("<h3><b>Id: </b>%s</h3>", $params->id)?>
            <?php echo sprintf("<h3><b>Name: </b>%s</h3>", $params->name)?>
            <?php echo sprintf("<h3><b>Unit: </b>%s</h3>", $params->unit)?>
            <?php echo sprintf("<h3><b>Price: </b>%s</h3>",$params->price)?>
            <?php echo sprintf("<h3><b>DateCreated: </b>%s</h3>", $params->dateCreated)?>
            <?php echo sprintf("<h3><b>DateUpdate: </b>%s</h3>", $params->dateUpdated)?>
            <?php echo sprintf("<h3><b>Description: </b>%s</h3>", $params->description)?>
            <?php echo sprintf("<h3><b>Active: </b>%s</h3>", $params->active ? "Yes" : "No")?>
            <div class="row">
                <?php echo sprintf("<a href='/products' style='text-decoration: none; color: white;' class='btn btn-info'>Go back to list</a> &nbsp;")?>
                <?php echo sprintf("<a href='/productEdit?id=%s' style='text-decoration: none; color: white;' class='btn btn-primary'>Edit</a> &nbsp;", $params->id)?>
                <form action="productDeleteProcess" method="post">
                    <?php echo sprintf("<input type='hidden' name='%s' value='%s'>", 'id', $params->id)?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
