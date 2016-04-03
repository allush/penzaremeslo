<?php
/* @var $this SiteController */
/* @var $model BackendLoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Вход';
$this->breadcrumbs = [
    'Вход',
];
?>

<h1>Вход</h1>

<?php $form = $this->beginWidget('CActiveForm', [
    'id' => 'login-form',
    'focus' => [$model, 'email'],
    'htmlOptions' => [
        'role' => 'form',
    ],
]); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model, 'email', ['class' => 'form-control']); ?>
    <?php echo $form->error($model, 'email'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password', ['class' => 'form-control']); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div class="checkbox">
    <label>
        <?php echo $form->checkBox($model, 'rememberMe'); ?>
        <?php echo $model->getAttributeLabel('rememberMe'); ?>
    </label>
    <?php echo $form->error($model, 'rememberMe'); ?>
</div>

<div class="form-group">
    <?php echo CHtml::submitButton('Войти', ['class' => 'btn btn-default col-md-12']); ?>
</div>

<?php $this->endWidget(); ?>
