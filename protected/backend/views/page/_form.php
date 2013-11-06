<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/ckeditor/ckeditor.js',
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/ckfinder/ckfinder.js',
    CClientScript::POS_HEAD
);
?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'page-form',
    'enableAjaxValidation' => false,
    'focus' => $model->isNewRecord ? array($model, 'name') : null,
));
?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'content'); ?>
    <?php echo $form->textArea($model, 'content', array('rows' => 6, 'class' => 'form-control')); ?>
    <?php echo $form->error($model, 'content'); ?>
</div>

<div class="form-group">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn btn-default')); ?>
</div>

<?php $this->endWidget(); ?>

<script>
    var editor = CKEDITOR.replace('Page[content]');
    CKFinder.setupCKEditor(editor, '/ckfinder/');
</script>