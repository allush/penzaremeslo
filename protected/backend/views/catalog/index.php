<?php
/* @var $this CatalogController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Каталоги',
);


$this->menu = array(
    array('label' => 'Создать', 'url' => array('create')),
);

$this->widget('system.web.widgets.CTreeView', array(
    'data' => Catalog::hierarchy(),
    'collapsed' => false,
    'unique' => false,
    'persist' => 'location',
    'animated' => 'fast'
));