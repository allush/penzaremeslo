<?php
/* @var $this UserController */
/* @var $model User */

$this->pageTitle = $model->fullName() . ' - Мастера';
$this->pageDescription = 'Мастер ' . $model->fullName();

if($model->userID == Yii::app()->user->getState('userID')) {
    $this->breadcrumbs = [
        'Мой профиль',
    ];
    if(!$model->hasPhoto()) {
        $this->renderPartial('_hidden');
    }
} else {
    $this->breadcrumbs = [
        'Мастера' => ['index'],
        $model->fullName(),
    ];
}

$this->menu = [
    ['label' => 'Назад', 'url' => ['index']],
    [
        'label' => 'Редактировать',
        'url' => ['update', 'id' => $model->userID],
        'visible' => $model->userID == Yii::app()->user->getState('userID'),
    ],
];
?>

<div class="row">
    <div class="col-md-3">
        <div class="text-center" style="margin-bottom: 12px;">
            <?php echo CHtml::image($model->photo(), '', ['class' => 'img-rounded', 'style' => 'max-width: 200px;']); ?>
        </div>

        <div class="text-center"><?php echo $model->fullName(); ?></div>
        <div class="text-center"><?php echo $model->phone; ?></div>
        <div class="text-center"><?php echo $model->email; ?></div>
        <br>

        <div class="text-center">
            <?php echo CHtml::link('Посмотреть работы мастера', ['/product/index', 'userID' => $model->userID],
                ['class' => 'btn btn-default btn-sm']) ?>
        </div>
    </div>

    <div class="col-md-9">
        <?php echo $model->description; ?>
    </div>
</div>