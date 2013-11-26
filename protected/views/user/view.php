<?php
/* @var $this UserController */
/* @var $model User */

$this->pageTitle = $model->fullName() . ' - Мастера';
$this->pageDescription = 'Мастер ' . $model->fullName();

if ($model->userID == Yii::app()->user->getState('userID')) {
    $this->breadcrumbs = array(
        'Мой профиль',
    );
} else {
    $this->breadcrumbs = array(
        'Мастера' => array('index'),
        $model->fullName(),
    );
}

$this->menu = array(
    array('label' => 'Назад', 'url' => array('index')),
    array('label' => 'Редактировать', 'url' => array('update', 'id' => $model->userID), 'visible' => $model->userID == Yii::app()->user->getState('userID')),
);
?>

<div class="row">
    <div class="col-md-3">
        <div class="text-center" style="margin-bottom: 12px;">
            <?php echo CHtml::image($model->photo(), '', array('class' => 'img-rounded', 'style' => 'max-width: 200px;')); ?>
        </div>

        <div class="text-center"><?php echo $model->fullName(); ?></div>
        <div class="text-center"><?php echo $model->phone; ?></div>
        <div class="text-center"><?php echo $model->email; ?></div>
        <br>
        <div class="text-center">
            <?php echo CHtml::link('Посмотреть работы мастера', array('/product/index','userID' => $model->userID), array('class' => 'btn btn-default btn-sm')) ?>
        </div>
    </div>

    <div class="col-md-9">
        <?php echo $model->description; ?>
    </div>
</div>