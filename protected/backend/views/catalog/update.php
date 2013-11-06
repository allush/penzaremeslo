<?php
/* @var $this CatalogController */
/* @var $model Catalog */

$returnUrl = isset(Yii::app()->request->urlReferrer) ? Yii::app()->request->urlReferrer : array('/product/index', 'c' => $model->catalogID);

$this->breadcrumbs = array(
    'Товары' => $returnUrl,
    'Редактирование каталога',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => $returnUrl),
    array(
        'label' => 'Удалить',
        'url' => '#',
        'linkOptions' => array(
            'class' => 'text-error',
            'submit' => array('delete', 'id' => $model->catalogID),
            'confirm' => 'Вы уверены? Подкаталоги(если они есть) станут каталогами верхнего уровня, а все товары ДАННОГО каталога не будут привязаны ни к одному каталогу.',
            'params' => array(
                'YII_CSRF_TOKEN' => Yii::app()->request->csrfToken,
            ),
        ),
        'itemOptions' => array('class' => 'pull-right')
    ),
);

echo $this->renderPartial('_form', array('model' => $model));