<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'viewData' => array(
        'itemCount' => $dataProvider->itemCount,
    ),
    'template' => '{items} {pager}',
    'summaryText' => '',
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
    'afterAjaxUpdate'=>'pageProductLoaded',
    'beforeAjaxUpdate' => 'pageProductLoading'
));
