<?php
use app\core\Application;

/** @var $params \app\models\ProductModel
 */

?>

<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <?php echo sprintf("<h3><b>Id: </b>%s</h3>", $params->id)?>
            <?php echo sprintf("<h3><b>Name: </b>%s</h3>", $params->name)?>
            <?php echo sprintf("<h3><b>Unit: </b>%s</h3>", $params->unit)?>
            <?php echo sprintf("<h3><b>Price: </b>%s</h3>",$params->price)?>
            <?php echo sprintf("<h3><b>DateCreated: </b>%s</h3>", $params->dateCreated)?>
            <?php echo sprintf("<h3><b>DateUpdate: </b>%s</h3>", $params->dateUpdated)?>
            <?php echo sprintf("<h3><b>Description: </b>%s</h3>", $params->description)?>
            <?php echo sprintf("<h3><b>Active: </b>%s</h3>", $params->active ? "Yes" : "No")?>
            <?php echo sprintf("<a href='/products' style='text-decoration: none; color: white;' class='btn btn-info'>Go back to list</a>")?>
            <?php echo sprintf("<a href='/productEdit?id=%s' style='text-decoration: none; color: white;' class='btn btn-primary'>Edit</a>", $params->id)?>
            <?php echo sprintf("<a href='/productDelete?id=%s' style='text-decoration: none; color: white;' class='btn btn-danger'>Delete</a>", $params->id)?>
        </div>
    </div>
</div>
