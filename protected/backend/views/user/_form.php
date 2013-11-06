<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
//        'class' => 'form-horizontal',
        'role'=>"form"
    )
));
?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'surname', array()); ?>
        <?php echo $form->textField($model, 'surname', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'surname'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array()); ?>
        <?php echo $form->textField($model, 'name', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'patronymic', array()); ?>
        <?php echo $form->textField($model, 'patronymic', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'patronymic'); ?>
    </div>


    <div class="form-group">
        <?php echo $form->labelEx($model, 'index', array()); ?>
        <?php echo $form->textField($model, 'index', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'index'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'country', array()); ?>
        <?php echo $form->textField($model, 'country', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'country'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'region', array()); ?>
        <?php echo $form->textField($model, 'region', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'region'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'sity', array()); ?>
        <?php echo $form->textField($model, 'sity', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'sity'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'address', array()); ?>
        <?php echo $form->textField($model, 'address', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'address'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'email', array()); ?>
        <?php echo $form->textField($model, 'email', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'email'); ?>

    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'phone', array()); ?>
        <?php echo $form->textField($model, 'phone', array('class' => 'form-control', 'maxlength' => 255)); ?>
        <?php echo $form->error($model, 'phone'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'activated', array()); ?>
        <?php echo $form->checkBox($model, 'activated', array('class' => 'form-control')); ?>
        <?php echo $form->error($model, 'activated'); ?>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'isAdmin', array()); ?>
        <div class="controls">
            <?php echo $form->checkBox($model, 'isAdmin', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'isAdmin'); ?>
        </div>
    </div>


    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'form-control')); ?>
    </div>

<?php $this->endWidget(); ?>