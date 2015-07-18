<?php
/* @var $this UserController */
/* @var $model User */

$this->menu = [
    ['label' => 'Редактировать', 'url' => ['update', 'id' => $model->userID]],
];

$this->breadcrumbs = [
    'Пользователи' => ['index'],
    $model->surname . ' ' . $model->name,
];

$this->widget('zii.widgets.CDetailView', [
    'data' => $model,
    'attributes' => [
        [
            'name' => 'Фото',
            'type' => 'raw',
            'value' => CHtml::image($model->photo(), "", ["style" => "width: 80px;"]),
        ],
        [
            'name' => 'is_founder',
            'value' => ($model->activated == 1 ? 'Да' : 'Нет'),
        ],
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
        [
            'name' => 'activated',
            'value' => ($model->activated == 1 ? 'Да' : 'Нет'),
        ],
    ],
    'htmlOptions' => [
        'class' => 'table table-striped table-condensed',
    ],
]);