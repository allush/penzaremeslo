<?php
/* @var $this SiteController */
/* @var $user User */
/* @var $form CActiveForm */

?>
    <h1>Регистрация</h1>
<?php
$form = $this->beginWidget('CActiveForm', array(
    'action' => array('/site/signUp'),
    'id' => 'signup-form',
    'enableAjaxValidation' => false,
    'focus' => array($user, 'name'),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
        'role' => 'form'
    )
));
?>
    <div class="form-group">
        <?php echo $form->labelEx($user, 'name', array('class' => 'col-md-1 control-label')); ?>
        <div class="col-md-3">
            <?php echo $form->textField($user, 'name', array('required' => 'required', 'class' => 'form-control')); ?>
            <?php echo $form->error($user, 'name'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($user, 'email', array('class' => 'col-md-1 control-label')); ?>
        <div class="col-md-3">
            <?php echo $form->emailField($user, 'email', array('required' => 'required', 'class' => 'form-control')); ?>
            <?php echo $form->error($user, 'email'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($user, 'password', array('class' => 'col-md-1 control-label')); ?>
        <div class="col-md-3">
            <?php echo $form->passwordField($user, 'password', array('required' => 'required', 'class' => 'form-control')); ?>
            <?php echo $form->error($user, 'password'); ?>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-offset-1 col-md-3">
            <?php echo CHtml::submitButton('Зарегистироваться', array('class' => 'form-control btn btn-default')); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>