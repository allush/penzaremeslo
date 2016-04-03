<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$returnUrl = isset(Yii::app()->request->urlReferrer) ? Yii::app()->request->urlReferrer : array('/product/index');

$this->breadcrumbs = array(
    'Товары' => array('product/index'),
    'Создание каталога',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => $returnUrl)
);

echo $this->renderPartial('_form', array('model' => $model));
