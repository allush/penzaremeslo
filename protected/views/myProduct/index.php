<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Мои товары',
);

$this->menu = array(
    array('label' => 'Добавить', 'url' => array('create')),
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'itemsTagName' => 'table',
    'itemsCssClass' => 'table table-bordered table-condensed table-hover',
    'sortableAttributes' => array(
        'name',
        'existence',
        'price',
        'catalogID',
        'createdOn',
        'modifiedOn',
    ),
    'enableHistory' => true,
    'template' => '  {pager}{summary}{sorter}{items}{pager}',
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