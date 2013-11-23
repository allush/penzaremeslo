<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Мастера' => array('index'),
    $model->fullName(),
);

?>

<div class="row">
    <div class="col-md-3">
        <div class="text-center" style="margin-bottom: 12px;">
            <?php echo CHtml::image($model->photo(), '', array('class' => 'img-rounded','style' => 'max-width: 200px;')); ?>
        </div>

        <div class="text-center"><?php echo $model->fullName(); ?></div>
        <div class="text-center"><?php echo $model->phone; ?></div>
        <div class="text-center"><?php echo $model->email; ?></div>

        <div class="text-center">
            <?php echo CHtml::link('Посмотреть работы мастера', array(), array('class' => 'btn btn-default')) ?>
        </div>
    </div>

    <div class="col-md-9">

        <?php echo $model->description; ?>
    </div>
</div>