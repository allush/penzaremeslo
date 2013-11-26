<?php
/* @var $this SiteController */
/* @var $model ChangePasswordForm */
/* @var $form CActiveForm */

$this->pageTitle = 'Восстановление пароля';

$this->breadcrumbs = array(
    'Восстановление пароля',
);
?>

<h1>Создание нового пароля</h1>
<div class="row">
    <div class="col-md-3">

        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'changePassword-form',
            'focus' => array($model, 'password'),
            'htmlOptions' => array(
                'role' => 'form',
            ),
            'errorMessageCssClass' => 'text-danger'
        )); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'password2'); ?>
            <?php echo $form->passwordField($model, 'password2', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'password2'); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton('Отправить', array('class' => 'form-control btn btn-default')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
