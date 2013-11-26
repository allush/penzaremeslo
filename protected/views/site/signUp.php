<?php
/* @var $this SiteController */
/* @var $model SignUpForm */
/* @var $form CActiveForm */

$this->pageTitle = 'Регистрация';

$this->breadcrumbs = array(
    'Регистрация',
);
?>

<div class="row">
    <div class="col-md-3">
        <h1>Регистрация</h1>

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'signUp-form',
            'focus' => array($model, 'name'),
            'htmlOptions' => array(
                'role' => 'form'
            ),
            'errorMessageCssClass' => 'text-danger'
        )); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->emailField($model, 'email', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton('Зарегистироваться', array('class' => 'form-control btn btn-default')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>