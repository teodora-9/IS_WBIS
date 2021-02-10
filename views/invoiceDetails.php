<?php
use app\core\Application;

/** @var $params \app\models\InvoiceModel
 */

?>

<div class="row">
    <div class="col-md-12">
        <div class="callout callout-info">
            <?php  $params->readOne($params->id); ?>
            <?php  $params->readTwo($params->id); ?>

        </div>
    </div>
</div>
<?php echo "<div class='card-footer'>" ?>
<?php echo sprintf("<a href='/invoices' style='text-decoration: none; color: white;' class='btn btn-info'>Go back to list</a>")?>
</div>