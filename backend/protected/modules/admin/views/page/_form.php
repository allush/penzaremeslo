<?php
/* @var $this PageController */
/* @var $model Page */
/* @var $form CActiveForm */
?>

<?php
$form = $this->beginWidget('CActiveForm', [
    'id' => 'page-form',
    'enableAjaxValidation' => false,
    'focus' => $model->isNewRecord ? [$model, 'name'] : null,
]);
?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name', ['class' => 'form-control']); ?>
    <?php echo $form->error($model, 'name'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'content'); ?>
    <?php echo $form->textArea($model, 'content', ['rows' => 6, 'class' => 'form-control']); ?>
    <?php echo $form->error($model, 'content'); ?>
</div>

<div class="form-group">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-default']); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    $(function (){
        var editor = CKEDITOR.replace('Page[content]');
        CKFinder.setupCKEditor(editor, '/ckfinder/');
    });
</script>