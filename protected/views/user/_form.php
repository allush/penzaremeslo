<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/ckeditor/ckeditor.js',
    CClientScript::POS_HEAD
);
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl . '/ckfinder/ckfinder.js',
    CClientScript::POS_HEAD
);

/** @var CActiveForm $form */
$form = $this->beginWidget('CActiveForm', [
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => [
        'role' => 'form',
        'enctype' => 'multipart/form-data',
    ],
    'errorMessageCssClass' => 'text-danger',
]);
?>

<?php if(!$model->hasPhoto()) {
    $this->renderPartial('_hidden');
} ?>

<div class="row">
    <div class="col-md-4">

        <div class="form-group">
            <?php echo $form->labelEx($model, 'photoFile', []); ?>
            <p>
                <?php
                if($model->photo()) {
                    echo CHtml::image($model->photo(), '', ['style' => 'max-width: 360px; margin-bottom: 20px;']);
                }
                ?>
            </p>
            <?php echo $form->fileField($model, 'photoFile', []); ?>
            <?php echo $form->error($model, 'photoFile'); ?>
        </div>

    </div>

    <div class="col-md-4">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'surname', []); ?>
            <?php echo $form->textField($model, 'surname', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?php echo $form->error($model, 'surname'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'name', []); ?>
            <?php echo $form->textField($model, 'name', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'patronymic', []); ?>
            <?php echo $form->textField($model, 'patronymic', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?php echo $form->error($model, 'patronymic'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'email', []); ?>
            <?php echo $form->emailField($model, 'email', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?php echo $form->error($model, 'email'); ?>

        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'phone', []); ?>
            <?php echo $form->telField($model, 'phone', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?php echo $form->error($model, 'phone'); ?>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'country', []); ?>
            <?php echo $form->textField($model, 'country', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?php echo $form->error($model, 'country'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'region', []); ?>
            <?php echo $form->textField($model, 'region', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?php echo $form->error($model, 'region'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'city', []); ?>
            <?php echo $form->textField($model, 'city', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?php echo $form->error($model, 'city'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'index', []); ?>
            <?php echo $form->textField($model, 'index', ['class' => 'form-control']); ?>
            <?php echo $form->error($model, 'index'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'address', []); ?>
            <?php echo $form->textField($model, 'address', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?php echo $form->error($model, 'address'); ?>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'description', []); ?>
            <?php echo $form->textArea($model, 'description', ['class' => 'form-control', 'rows' => 6]); ?>
            <?php echo $form->error($model, 'description'); ?>
        </div>
    </div>
</div>

<div class="form-group">
    <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', ['class' => 'btn btn-primary']); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    var editor = CKEDITOR.replace('User[description]');
    CKFinder.setupCKEditor(editor, '/ckfinder/');
</script>