<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>
<style type="text/css">
    .thumb {
        padding: 4px 8px 4px 4px;
        margin-top: 4px;
        border-bottom: 1px solid #ccc;
    }

    .thumb:hover {
        background-color: #efefef;
    }

    .thumb.active {
        background-color: #F5D7D7;
    }
</style>

<div class="row">
    <div class="col-md-3">
        <?php echo CHtml::image($model->thumbnail(), '', array('id' => 'mainPicture', 'style' => 'max-width: 260px;max-height: 195px;')); ?>
        <div class="myProduct-thumbnails">
        <?php foreach ($model->pictures as $picture) { ?>
        <div class="thumb <?php echo($picture->cover == 1 ? 'active' : ''); ?>">
            <?php
            echo CHtml::image($picture->thumbnail(), '', array('style' => "width: 64px; cursor: pointer;"));

            echo CHtml::link(
                '<span class="glyphicon glyphicon-trash"></span>',
                '#',
                array(
                    'style' => 'position: relative; top: 10px;',
                    'title' => 'Удалить',
                    'class' => 'btn btn-xs btn-danger pull-right',
                    'submit' => array('deletePicture', 'productPictureID' => $picture->productPictureID),
                    'confirm' => 'Вы уверены?',
                    'params' => array('YII_CSRF_TOKEN' => Yii::app()->request->csrfToken),
                ));

            echo CHtml::link(
                '<span class="glyphicon glyphicon-picture"></span>',
                array('setCover', 'pictureID' => $picture->productPictureID, 'id' => $model->productID),
                array(
                    'style' => 'position: relative; top: 10px; right: 4px;',
                    'title' => 'Сделать главной',
                    'class' => 'btn btn-xs btn-info pull-right',
                ));

            echo '</div>';
            }
            ?>
        </div>
    </div>


        <script type="text/javascript">
            $('.myProduct-thumbnails img').click(function () {
                $('#mainPicture').attr('src', $(this).attr('src'));
            });
        </script>

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => array('update', 'id' => $model->productID),
        'id' => 'product-form',
        'enableAjaxValidation' => true,
        'htmlOptions' => array(
            'class' => 'form-horizontal',
            'role' => 'form'
        ),
    ));
    ?>
    <div class="col-md-5">
        <div class="form-group">
            <?php
            echo $form->labelEx($model, 'name');
            echo $form->textField($model, 'name', array(
                'class' => 'form-control',
                'title' => $model->getAttributeLabel('name'),
            ));
            echo $form->error($model, 'name');
            ?>
        </div>

        <div class="form-group">
            <?php
            echo $form->labelEx($model, 'description');
            echo $form->textArea($model, 'description', array(
                'rows' => 11,
                'class' => 'form-control',
                'title' => $model->getAttributeLabel('description'),
            ));
            echo $form->error($model, 'description');
            ?>
        </div>
    </div>

    <div class="col-md-4">
        <!--        <div>--><?php //echo 'Создан:' . date("H:i:s d/m/Y", $model->createdOn);?><!--</div>-->
        <!--        <div>--><?php //echo 'Изменен:' . date("H:i:s d/m/Y", $model->modifiedOn);?><!--</div>-->

        <div class="form-group">
            <?php echo $form->labelEx($model, 'userID', array('class' => 'col-md-3 control-label')); ?>
            <div class="col-md-9">
                <?php
                echo $form->dropDownList($model, 'userID',

                    CHtml::listData(User::model()->findAll(array('order' => 'surname ASC')), 'userID', 'surname'),array(
                        'class' => 'form-control',
                        'title' => $model->getAttributeLabel('userID'),
                    ));
                echo $form->error($model, 'userID');  ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'productStatusID', array('class' => 'col-md-3 control-label')); ?>
            <div class="col-md-9">
                <?php
                echo $form->dropDownList($model, 'productStatusID',
                    CHtml::listData(ProductStatus::model()->findAll(), 'productStatusID', 'name'),
                    array('class' => 'form-control', 'title' => $model->getAttributeLabel('productStatusID'))
                );
                echo $form->error($model, 'productStatusID');
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'catalogID', array('class' => 'col-md-3 control-label')); ?>
            <div class="col-md-9">
                <?php
                echo $form->dropDownList($model, 'catalogID',
                    Catalog::dropDownHierarchy(),
                    array('class' => 'form-control', 'title' => $model->getAttributeLabel('catalogID'), 'prompt' => '')
                );
                echo $form->error($model, 'catalogID');
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'unit', array('class' => 'col-md-3 control-label')); ?>
            <div class="col-md-9">
                <?php echo $form->textField($model, 'unit', array('class' => 'form-control')); ?>
                <?php echo $form->error($model, 'unit'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'discount', array('class' => 'col-md-3 control-label')); ?>
            <div class="col-md-9">
                <?php
                echo $form->numberField($model, 'discount', array(
                    'class' => 'form-control',
                    'title' => $model->getAttributeLabel('discount'),
                    'min' => 0,
                    'max' => '100',
                    'step' => 1
                ));
                echo $form->error($model, 'discount');
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'price', array('class' => 'col-md-3 control-label')); ?>
            <div class="col-md-9">
                <?php
                echo $form->numberField($model, 'price',
                    array('class' => 'form-control', 'title' => $model->getAttributeLabel('price'),)
                );
                echo $form->error($model, 'price');
                ?>
            </div>
        </div>


        <div class="form-group">
            <?php echo $form->labelEx($model, 'existence', array('class' => 'col-md-3 control-label')); ?>
            <div class="col-md-9">
                <?php
                echo $form->numberField($model, 'existence', array(
                    'class' => 'form-control',
                    'title' => $model->getAttributeLabel('existence'),
                ));
                echo $form->error($model, 'existence'); ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php $this->endWidget(); ?>
</div>

<br>

<div class="row">
    <div class="col-md-12">
        <script type="text/javascript">

            // Convert divs to queue widgets when the DOM is ready
            $(function () {
                var uploader = $("#uploader").pluploadQueue({
                    // General settings
                    runtimes: 'html5,gears,flash,silverlight,browserplus',
                    url: '<?php echo $this->createUrl('uploadPicture', array('productID' => $model->productID))?>',
                    max_file_size: '8mb',
                    //            chunk_size: '1mb',
                    unique_names: true,
                    // Resize images on clientside if we can
                    resize: {width: 1200, height: 900, quality: 90},
                    // Specify what files to browse for
                    filters: [
                        {title: "Image files", extensions: "jpg,jpeg,gif,png"},
                        {title: "Zip files", extensions: "zip"}
                    ],
                    multipart_params: {
                        YII_CSRF_TOKEN: '<?php echo Yii::app()->request->csrfToken;?>'
                    },
                    // Flash settings
                    flash_swf_url: '/plupload/js/plupload.flash.swf',
                    // Silverlight settings
                    silverlight_xap_url: '/plupload/js/plupload.silverlight.xap'
                });

                // Client side form validation
                $('form').submit(function (e) {
                    var uploader = $('#uploader').pluploadQueue();
                    // Files in queue upload them first
                    if (uploader.files.length > 0) {
                        // When all files are uploaded submit form
                        uploader.bind('StateChanged', function () {
                            if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                                $('form')[0].submit();
                            }
                        });
                        uploader.start();
                    } else {
                        alert('You must queue at least one file.');
                    }
                    return false;
                });
            });
        </script>

        <form>
            <div id="uploader">
                <p>Ваш браузер не поддерживает ни одну из технологий: Flash, Silverlight, Gears, BrowserPlus, HTML5.</p>
            </div>
        </form>
    </div>
</div>