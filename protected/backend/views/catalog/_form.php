<?php
/* @var $this CatalogController */
/* @var $model Catalog */
/* @var $form CActiveForm */
?>

<div class="row">
    <div class="col-md-3">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id' => 'catalog-form',
            'enableAjaxValidation' => false,
        )); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'name'); ?>
            <?php echo $form->textField($model, 'name', array('class' => 'form-control')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'parent'); ?>

            <?php
            $criteria = new CDbCriteria();
            $criteria->order = 'name ASC';
            // если каталог редактируется, то не показывать в качестве родительского каталога самого себя
            if (!$model->isNewRecord) {
                $criteria->condition = 'catalogID<>:catalogID';
                $criteria->params = array(':catalogID' => $model->catalogID);
            }

            $htmlOptions = array('class' => 'form-control', 'prompt' => '');

            echo $form->dropDownList($model, 'parent', CHtml::listData(Catalog::model()->findAll($criteria), 'catalogID', 'name'), $htmlOptions);
            echo $form->error($model, 'parent'); ?>
        </div>

        <div class="form-group">
            <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить', array('class' => 'btn btn-default form-control')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div><!-- form -->