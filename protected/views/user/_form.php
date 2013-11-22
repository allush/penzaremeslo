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
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'role' => "form"
    )
));
?>
    <div class="row">
        <div class="col-md-4">

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
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'email', array()); ?>
                <?php echo $form->emailField($model, 'email', array('class' => 'form-control', 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'email'); ?>

            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'phone', array()); ?>
                <?php echo $form->telField($model, 'phone', array('class' => 'form-control', 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'phone'); ?>
            </div>
        </div>

        <div class="col-md-4">
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
                <?php echo $form->labelEx($model, 'city', array()); ?>
                <?php echo $form->textField($model, 'city', array('class' => 'form-control', 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'city'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'index', array()); ?>
                <?php echo $form->textField($model, 'index', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'index'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'address', array()); ?>
                <?php echo $form->textField($model, 'address', array('class' => 'form-control', 'maxlength' => 255)); ?>
                <?php echo $form->error($model, 'address'); ?>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?php echo $form->labelEx($model, 'description', array()); ?>
                <?php echo $form->textArea($model, 'description', array('class' => 'form-control', 'rows' => 6)); ?>
                <?php echo $form->error($model, 'description'); ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn btn-default form-control')); ?>
    </div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    var editor = CKEDITOR.replace('User[description]');
    CKFinder.setupCKEditor(editor, '/ckfinder/');
</script>