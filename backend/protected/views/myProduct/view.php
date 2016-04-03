<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Мои товары' => array('index'),
    '#' . $model->productID . ' ' . $model->name,
);

$this->menu = array(
    array('label' => 'Назад', 'url' => (isset(Yii::app()->request->urlReferrer)) ? Yii::app()->request->urlReferrer .'#product_'.$model->productID: array('index')),
    array(
        'label' => 'Удалить',
        'url' => '#',
        'linkOptions' => array(
            'class' => 'text-danger',
            'submit' => array('delete', 'id' => $model->productID),
            'confirm' => 'Are you sure you want to delete this item?',
            'params' => array(
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        ),
        'itemOptions' => array('class' => 'pull-right')
    ),
);
$this->renderPartial('_form', array('model' => $model));