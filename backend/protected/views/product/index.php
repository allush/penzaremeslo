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
                    <?php echo CHtml::beginForm('/product/index', 'get', array(
                        'class' => 'form-inline',
                        'role' => 'form',
                        'id' => 'filter-form'
                    )); ?>

                    <?php if(isset($_GET['c'])) {
                        echo CHtml::hiddenField('c', $_GET['c']);
                    } ?>

                    <div class="form-group">
                        <?php
                        echo CHtml::label('', '', array('class' => 'sr-only'));
                        echo CHtml::dropDownList('userID', $author, $authors, array(
                                'id' => 'userID',
                                'prompt' => 'Все авторы',
                                'class' => 'form-control',
                            )
                        ); ?>
                    </div>

                    <div class="form-group">
                        <?php
                        echo CHtml::label('', '', array('class' => 'sr-only'));
                        echo CHtml::dropDownList('sorting', $sorting, ProductController::$sorting, array(
                                'id' => 'sorting',
                                'class' => 'form-control',
                            )
                        ); ?>
                    </div>
                    <?php echo CHtml::endForm(); ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function() {
            $('#filter-form').change(function() {
                $(this).submit();
            });
        });
    </script>

<?php $this->renderPartial('_index', array('dataProvider' => $dataProvider)); ?>