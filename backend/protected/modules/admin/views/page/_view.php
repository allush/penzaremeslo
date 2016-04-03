<?php
/* @var $this PageController */
/* @var $data Page */
?>

<li><?php echo CHtml::link($data->name, array('update', 'id' => $data->pageID)); ?></li>