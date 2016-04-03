<?php
/* @var $this NewsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Новости',
);

$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
);

$this->widget('zii.widgets.CListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    'itemsTagName' => 'ul',
    'itemsCssClass' => 'list-unstyled',
    'sortableAttributes' => array(
        'header',
        'createdOn'
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
