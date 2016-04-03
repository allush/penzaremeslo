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
]); ?>

<div class="row">
    <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <?= $form->labelEx($model, 'photoFile'); ?>
            <p>
                <?php
                if($model->photo()) {
                    echo CHtml::image($model->photo(), '', [
                        'style' => 'max-height: 260px; max-width: 260px; margin-bottom: 20px;',
                    ]);
                }
                ?>
            </p>
            <?= $form->fileField($model, 'photoFile'); ?>
            <?= $form->error($model, 'photoFile'); ?>
        </div>

    </div>
    <div class="col-md-4 col-sm-4">
        <div class="well">
            <div class="form-group">
                <div class="checkbox">
                    <?= $form->checkBox($model, 'is_founder'); ?>
                    <?= $model->getAttributeLabel('is_founder') ?>
                </div>
                <?= $form->error($model, 'is_founder'); ?>
            </div>

            <div class="form-group">
                <?= $form->labelEx($model, 'pos'); ?>
                <?= $form->numberField($model, 'pos', ['class' => 'form-control']); ?>
                <?= $form->error($model, 'pos'); ?>
            </div>
        </div>
        <div class="form-group">
            <?= $form->labelEx($model, 'surname'); ?>
            <?= $form->textField($model, 'surname', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?= $form->error($model, 'surname'); ?>
        </div>

        <div class="form-group">
            <?= $form->labelEx($model, 'name'); ?>
            <?= $form->textField($model, 'name', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?= $form->error($model, 'name'); ?>
        </div>

        <div class="form-group">
            <?= $form->labelEx($model, 'patronymic'); ?>
            <?= $form->textField($model, 'patronymic', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?= $form->error($model, 'patronymic'); ?>
        </div>
        <div class="form-group">
            <?= $form->labelEx($model, 'email'); ?>
            <?= $form->emailField($model, 'email', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?= $form->error($model, 'email'); ?>

        </div>

        <div class="form-group">
            <?= $form->labelEx($model, 'phone'); ?>
            <?= $form->telField($model, 'phone', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?= $form->error($model, 'phone'); ?>
        </div>
    </div>

    <div class="col-md-4 col-sm-4">
        <div class="form-group">
            <?= $form->labelEx($model, 'country'); ?>
            <?= $form->textField($model, 'country', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?= $form->error($model, 'country'); ?>
        </div>

        <div class="form-group">
            <?= $form->labelEx($model, 'region'); ?>
            <?= $form->textField($model, 'region', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?= $form->error($model, 'region'); ?>
        </div>

        <div class="form-group">
            <?= $form->labelEx($model, 'city'); ?>
            <?= $form->textField($model, 'city', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?= $form->error($model, 'city'); ?>
        </div>

        <div class="form-group">
            <?= $form->labelEx($model, 'index'); ?>
            <?= $form->textField($model, 'index', ['class' => 'form-control']); ?>
            <?= $form->error($model, 'index'); ?>
        </div>

        <div class="form-group">
            <?= $form->labelEx($model, 'address'); ?>
            <?= $form->textField($model, 'address', ['class' => 'form-control', 'maxlength' => 255]); ?>
            <?= $form->error($model, 'address'); ?>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <?= $form->labelEx($model, 'description'); ?>
            <?= $form->textArea($model, 'description', ['class' => 'form-control', 'rows' => 6]); ?>
            <?= $form->error($model, 'description'); ?>
        </div>
    </div>
</div>

<div class="form-group">
    <?= CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', [
        'class' => 'btn btn-primary',
    ]); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">
    var editor = CKEDITOR.replace('User[description]');
    CKFinder.setupCKEditor(editor, '/ckfinder/');
</script>