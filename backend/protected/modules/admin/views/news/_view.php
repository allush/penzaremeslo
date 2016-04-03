<?php
/** @var $data News */
?>
<li>
    <?php echo '<small>'.date('d.m.Y', $data->createdOn) . '</small> ' . CHtml::link($data->header, array("update", "id" => $data->newsID)); ?>
</li>
