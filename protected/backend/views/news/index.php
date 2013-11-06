<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Новости',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
);
$form = $this->beginWidget('CActiveForm', array(
    'action' => array('groupAction'),
    'id' => 'product-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(),
));

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'itemsTagName' => 'table',
    'itemsCssClass' => 'table table-bordered table-condensed table-hover',
    'sortableAttributes' => array(
        'header',
    ),
    'template' => '{summary} {sorter} {items} {pager}',
    'summaryText' => '{start} - {end} из {count}',
    'pagerCssClass' => 'yiiPager pull-left',
    'pager' => array(
        'firstPageLabel' => '<<',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'lastPageLabel' => '>>',
        'maxButtonCount' => '10',
        'header' => '',
        'cssFile' => '',
        'selectedPageCssClass' => 'active',
        'hiddenPageCssClass' => '',
        'htmlOptions' => array(
            'class' => 'pagination',
        )
    ),
));

$this->endWidget();
