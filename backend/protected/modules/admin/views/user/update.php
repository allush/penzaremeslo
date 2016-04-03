<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Пользователи' => array('index'),
    $model->surname . ' ' . $model->name => array('view', 'id' => $model->userID),
    'Редактирование',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => Yii::app()->request->urlReferrer),
);

echo $this->renderPartial('_form', array('model' => $model));
