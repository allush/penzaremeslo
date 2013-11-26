<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */
/* @var $popularNews CActiveDataProvider */

$this->pageTitle = 'Новости';
$this->pageDescription = 'Новости';

$this->breadcrumbs = array(
    'Новости',
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
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

