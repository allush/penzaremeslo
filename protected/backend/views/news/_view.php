<?php
/** @var $data News */
?>

<div class="form-group">

    <div class="checkbox">
        <?php
        echo CHtml::checkBox('');
        echo CHtml::link($data->header, array("update", "id" => $data->newsID));
        ?>
    </div>
</div>