<?php
/* @var $this SiteController */
/* @var $model SignInForm */
/* @var $form CActiveForm */

$this->pageTitle = 'Вход';

$this->breadcrumbs = array(
    'Вход',
);
?>

<div class="row">
    <div class="col-md-3">

        <h1>Вход</h1>

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-form',
            'focus' => array($model, 'email'),
            'htmlOptions' => array(
                'role' => 'form',
            ),
            'errorMessageCssClass' => 'text-danger'
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
            <?php echo CHtml::submitButton('Войти', array('class' => 'form-control btn btn-default')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
