<?php
/* @var $this PageController */
/* @var $model Page */

$this->breadcrumbs = array(
    'Страницы' => array('index'),
    'Редактирование "' . $model->name . '"',
);

$this->menu = array(
    array(
        'label' => 'Назад',
        'url' => array('index')
    ),
);

if (Yii::app()->user->hasFlash('success')) {
    ?>
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo Yii::app()->user->getFlash('success');?>
    </div>
<?php
}
echo $this->renderPartial('_form', array('model' => $model)); ?>