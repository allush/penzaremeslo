<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */
/* @var $hierarchy array */

$this->breadcrumbs = array(
    'Товары',
);

$this->renderPartial('_menu');
?>

<div class="row">
    <div class="col-md-3">
        <?php $this->widget('system.web.widgets.CTreeView', array(
            'data' => $hierarchy,
            'collapsed' => true,
            'unique' => true,
            'persist' => 'location',
            'animated' => 'fast'
        )); ?>
    </div>
    <div class="col-md-9">
        <?php $this->widget('zii.widgets.CListView', array(
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
            'itemsTagName' => 'table',
            'itemsCssClass' => 'table table-bordered table-condensed table-hover',
            'sortableAttributes' => array(
                'name',
                'discount',
                'productStatusID',
                'createdOn',
                'modifiedOn',
            ),
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
        )); ?>
    </div>
</div>