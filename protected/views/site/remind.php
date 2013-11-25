<?php
/* @var $this SiteController */
/* @var $model RemindForm */
/* @var $form CActiveForm */

$this->breadcrumbs = array(
    'Восстановление пароля',
);
?>

<h1>Восстановление пароля</h1>
<div class="row">
    <div class="col-md-3">


        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'remind-form',
            'focus' => array($model, 'email'),
            'htmlOptions' => array(
                'role' => 'form',
            ),
            'errorMessageCssClass' => 'text-danger'
        )); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->emailField($model, 'email', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>

        <div class="form-group">

            <?php if (CCaptcha::checkRequirements()) {
                ?>
                <div> <?php $this->widget('CCaptcha',array(
                        'buttonLabel' => '<i class="glyphicon glyphicon-refresh"></i>',
                    )); ?> </div>
                <?php
                echo $form->labelEx($model, 'verifyCode');
                echo $form->telField($model, 'verifyCode', array('class' => 'form-control'));
                echo $form->error($model, 'verifyCode');
            }?>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton('Отправить', array('class' => 'form-control btn btn-default')); ?>
        </div>

        <?php $this->endWidget(); ?>

    </div>
</div>
