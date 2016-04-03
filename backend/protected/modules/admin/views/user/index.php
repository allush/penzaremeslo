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
    ],
]);

