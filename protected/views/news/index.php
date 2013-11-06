<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */
/* @var $popularNews CActiveDataProvider */


$this->breadcrumbs = array(
    'Новости',
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
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
    ),
    'id' => 'product-container',
    'afterAjaxUpdate' => 'pageProductLoaded',
    'beforeAjaxUpdate' => 'pageProductLoading'
));
?>

