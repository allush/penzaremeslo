<?php
/* @var $this NewsController */
/* @var $model News */
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
    'id' => 'news-form',
    'enableAjaxValidation' => false,
    'focus' => $model->isNewRecord ? array($model, 'name') : null,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data'
    )
));
?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'header'); ?>
    <?php echo $form->textField($model, 'header', array('class' => 'form-control')); ?>
    <?php echo $form->error($model, 'header'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'content'); ?>
    <?php echo $form->textArea($model, 'content'); ?>
    <?php echo $form->error($model, 'content'); ?>
</div>

<div class="form-group">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn btn-default')); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    var editor = CKEDITOR.replace('News[content]');
    CKFinder.setupCKEditor(editor, '/ckfinder/');
</script>