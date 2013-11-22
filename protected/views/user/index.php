<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */


$this->breadcrumbs = array(
    'Мастера',
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'viewData' => array(
        'itemCount' => $dataProvider->itemCount,
    ),
    'itemView' => '_view',
    'template' => '{items} {pager}',
    'summaryText' => '',
    'emptyText' => '',
    'pagerCssClass' => 'pager',
    'pager' => array(
        'firstPageLabel' => '<<',
        'prevPageLabel' => '<',
        'nextPageLabel' => '>',
        'lastPageLabel' => '>>',
        'maxButtonCount' => '7',
        'header' => '',
        'cssFile' => '',
        'selectedPageCssClass' => 'active',
    )
));

