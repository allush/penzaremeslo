<?php
/* @var $this UserController */
/* @var $model User */

$this->menu = array(
    array('label' => 'Редактировать', 'url' => array('update', 'id' => $model->userID)),
);

$this->breadcrumbs = array(
    'Мой профиль',
);

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        'surname',
        'name',
        'patronymic',
        'address',
        'index',
        'country',
        'region',
        'city',
        'email',
        'phone',
        array(
            'name' => 'activated',
            'value' => ($model->activated == 1 ? 'Да' : 'Нет')
        ),
    ),
    'htmlOptions' => array(
        'class' => 'table table-striped table-condensed'
    )
));