<?php
/* @var $this ProductController */
/* @var $dataProvider CActiveDataProvider */
/* @var $authors array() */
/* @var $author int */
/* @var $sorting int */
?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body" style="padding: 15px 8px">
                    <?php echo CHtml::beginForm('/product/index', 'get', array('class' => 'form-inline', 'role' => 'form', 'id' => 'filter-form')); ?>

                    <div class="form-group" style="margin-right: 12px; width: 170px;">
                        <?php
                        echo CHtml::label('', '', array('class' => 'sr-only'));
                        echo CHtml::dropDownList(
                            'author',
                            $author,
                            $authors,
                            array(
                                'id' => 'userID',
                                'prompt' => 'Все авторы',
                                'class' => 'form-control',
                                'ajax' => array(
                                    'type' => 'get',
                                    'url' => '/product/fetchData',
                                    'success' => 'function(data){
                                                    $("#product-container").html(data);
                                                    productPushState();
                                                 }',
                                    'data' => array(
                                        'userID' => 'js:$(this).attr(\'value\')',
                                        'sorting' => 'js:$(\'#sorting\').attr(\'value\')',
                                        'c' => isset($_GET['c']) ? $_GET['c'] : null,
                                    ),
                                )
                            )
                        ); ?>
                    </div>

                    <div class="form-group" style="margin-right: 12px; width: 170px;">
                        <?php
                        echo CHtml::label('', '', array('class' => 'sr-only'));
                        echo CHtml::dropDownList(
                            'sorting',
                            $sorting,
                            array(
                                ProductController::SORTING_DATE_DESC => 'Новые вверху',
                                ProductController::SORTING_DATE_ASC => 'Новые внизу',
                                ProductController::SORTING_PRICE_DESC => 'Цена ↓',
                                ProductController::SORTING_PRICE_ASC => 'Цена ↑',
                                ProductController::SORTING_NAME_DESC => 'Наименование ↓',
                                ProductController::SORTING_NAME_ASC => 'Наименование ↑',
                                ProductController::SORTING_AUTHOR_DESC => 'Автор ↓',
                                ProductController::SORTING_AUTHOR_ASC => 'Автор ↑',
                            ),
                            array(
                                'id' => 'sorting',
                                'class' => 'form-control',
                                'ajax' => array(
                                    'type' => 'get',
                                    'url' => '/product/fetchData',
                                    'success' => 'function(data){
                                                    $("#product-container").html(data);
                                                    productPushState();
                                                 }',
                                    'data' => array(
                                        'userID' => 'js:$(\'#userID\').attr(\'value\')',
                                        'sorting' => 'js:$(this).attr(\'value\')',
                                        'c' => isset($_GET['c']) ? $_GET['c'] : null,
                                    ),
                                )
                            )
                        ); ?>
                    </div>
                    <?php echo CHtml::endForm(); ?>
                </div>
            </div>
        </div>
    </div>

<?php $this->renderPartial('_index', array('dataProvider' => $dataProvider)); ?>