<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', [
    'id' => 'news-form',
    'enableAjaxValidation' => false,
    'focus' => $model->isNewRecord ? [$model, 'name'] : null,
    'htmlOptions' => [
        'enctype' => 'multipart/form-data',
    ],
]);
?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'header'); ?>
    <?php echo $form->textField($model, 'header', ['class' => 'form-control']); ?>
    <?php echo $form->error($model, 'header'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'content'); ?>
    <?php echo $form->textArea($model, 'content'); ?>
    <?php echo $form->error($model, 'content'); ?>
</div>

<div class="form-group">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-default']); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function (){
        var editor = CKEDITOR.replace('News[content]');
        CKFinder.setupCKEditor(editor, '/src/components/ckfinder/');
    });
</script>