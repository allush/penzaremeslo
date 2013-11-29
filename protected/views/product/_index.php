<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'viewData' => array(
        'itemCount' => $dataProvider->itemCount,
    ),
    'id' => 'product-container',
    'template' => '{items} {pager}',
    'summaryText' => '',
    'emptyText' => '',
    'pagerCssClass' => 'pager-undefined',
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
    'ajaxUpdate' => 'product-container',
    'afterAjaxUpdate' => 'productPageLoaded',
));