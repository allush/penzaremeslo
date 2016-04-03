<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = [
    'Пользователи',
];

$this->widget('zii.widgets.grid.CGridView', [
    'dataProvider' => $dataProvider,
    'summaryText' => '{start} - {end} из {count}',
    'summaryCssClass' => 'pull-right',
    'itemsCssClass' => 'table table-condensed table-hover',
    'pagerCssClass' => 'yiiPager pull-left',
    'pager' => [
        'firstPageLabel' => '<<',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'lastPageLabel' => '>>',
        'maxButtonCount' => '10',
        'header' => '',
        'cssFile' => '',
        'selectedPageCssClass' => 'active',
        'hiddenPageCssClass' => '',
        'htmlOptions' => [
            'class' => 'pagination',
        ],
    ],
    'rowCssClassExpression' => '!$data->isShown() ? "danger": ""',
    'showTableOnEmpty' => false,
    'emptyText' => 'Нет ни одного пользователя',
    'columns' => [
        [
            'header' => 'Фото',
            'type' => 'raw',
            'value' => 'CHtml::image($data->photo(),"",["style" => "width: 80px;"])',
        ],
        [
            'header' => 'ФИО',
            'name' => 'surname',
            'type' => 'raw',
            'value' => 'CHtml::link($data->surname." ".$data->name." ".$data->patronymic, array("update","id"=>$data->userID))',
        ],
        'email',
        'phone',
        [
            'name' => 'is_founder',
            'value' => '($data->is_founder == 1)?"Да":"Нет"',
        ],
        [
            'name' => 'activated',
            'value' => '($data->activated == 1)?"Да":"Нет"',
        ],
        [
            'name' => 'hidden',
            'value' => '($data->hidden == 1)? "Да" : "Нет"',
        ],
        [
            'class' => 'CButtonColumn',
            'htmlOptions' => [
                'style' => 'min-width: 80px',
            ],
            'template' => '{show} {hide} {delete}',
            'deleteButtonLabel' => '<i class="btn btn-danger btn-xs glyphicon glyphicon-remove"></i>',
            'deleteButtonImageUrl' => false,
            'deleteButtonOptions' => ['title' => 'Удалить'],
            'buttons' => [
                'hide' => [
                    'label' => '<i class="btn btn-warning btn-xs glyphicon glyphicon-eye-close"></i>',
                    'url' => 'Yii::app()->urlManager->createUrl("admin/user/hide",["id" => $data->userID])',
                    'imageUrl' => false,
                    'options' => [
                        'title' => 'Скрыть',
                    ],
                    'visible' => '!$data->hidden'
                ],
                'show' => [
                    'label' => '<i class="btn btn-default btn-xs glyphicon glyphicon-eye-open"></i>',
                    'url' => 'Yii::app()->urlManager->createUrl("admin/user/show",["id" => $data->userID])',
                    'imageUrl' => false,
                    'options' => [
                        'title' => 'Показать',
                    ],
                    'visible' => '$data->hidden'
                ],
            ],
        ],
    ],
]);

