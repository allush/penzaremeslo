<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->pageTitle = 'Мастера';
$this->pageDescription = 'Мастера';

$this->breadcrumbs = array(
    'Мастера',
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'viewData' => array(
        'itemCount' => $dataProvider->itemCount,
    ),
    'template' => '{items} {pager}',
    'summaryText' => '',
    'emptyText' => '',
    'pagerCssClass' => '',
    'pager' => array(
        'firstPageLabel' => '<<',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'lastPageLabel' => '>>',
        'maxButtonCount' => '7',
        'header' => '',
        'selectedPageCssClass' => 'active',
        'htmlOptions' => array(
            'class' => 'pagination',
        )
    ),
));

