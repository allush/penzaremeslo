<?php
/* @var $this SiteController */
/* @var $model BackendLoginForm */
/* @var $form CActiveForm */

$this->pageTitle = Yii::app()->name . ' - Вход';
$this->breadcrumbs = array(
    'Вход',
);
?>

<h1>Вход</h1>

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'focus' => array($model, 'email'),
    'htmlOptions' => array(
        'role' => 'form',
    )
)); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'email'); ?>
    <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'email'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'password'); ?>
    <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'password'); ?>
</div>

<div class="checkbox">
    <?php echo $form->label($model, 'rememberMe'); ?>
    <?php echo $form->checkBox($model, 'rememberMe'); ?>
    <?php echo $form->error($model, 'rememberMe'); ?>
</div>

<div class="form-group">
    <?php echo CHtml::submitButton('Войти', array('class' => 'btn btn-default')); ?>
</div>

<?php $this->endWidget(); ?>
