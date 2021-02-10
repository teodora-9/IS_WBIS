<?php
use app\core\Application;

/** @var $params \app\models\CustomerModel
 */

?>

<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <h1>Are you sure?</h1>
            <?php echo sprintf("<h3><b>Id: </b>%s</h3>", $params->id)?>
            <?php echo sprintf("<h3><b>Name: </b>%s</h3>", $params->name)?>
            <?php echo sprintf("<h3><b>Email: </b>%s</h3>", $params->email)?>
            <?php echo sprintf("<h3><b>Number: </b>%s</h3>",$params->number)?>
            <?php echo sprintf("<h3><b>Address: </b>%s</h3>",$params->address)?>
            <?php echo sprintf("<h3><b>DateCreated: </b>%s</h3>", $params->dateCreated)?>
            <?php echo sprintf("<h3><b>DateUpdate: </b>%s</h3>", $params->dateUpdated)?>
            <?php echo sprintf("<h3><b>Description: </b>%s</h3>", $params->description)?>
            <?php echo sprintf("<h3><b>Active: </b>%s</h3>", $params->active ? "Yes" : "No")?>
            <div class="row">
                <?php echo sprintf("<a href='/customers' style='text-decoration: none; color: white;' class='btn btn-info'>Go back to list</a> &nbsp;")?>
                <?php echo sprintf("<a href='/customerEdit?id=%s' style='text-decoration: none; color: white;' class='btn btn-primary'>Edit</a> &nbsp;", $params->id)?>
                <form action="customerDeleteProcess" method="post">
                    <?php echo sprintf("<input type='hidden' name='%s' value='%s'>", 'id', $params->id)?>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
