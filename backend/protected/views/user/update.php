<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs = array(
    'Мой профиль' => array('view','id' => $model->userID),
    'Редактирование',
);

$this->menu = array(
    array('label' => 'Назад', 'url' => array('view','id' => $model->userID)),
);

echo $this->renderPartial('_form', array('model' => $model));
