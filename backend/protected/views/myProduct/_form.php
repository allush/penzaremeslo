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
        <?php echo CHtml::image($model->thumbnail(), '',
            ['id' => 'mainPicture', 'style' => 'max-width: 260px;max-height: 195px;']); ?>
        <div class="myProduct-thumbnails"
        ">
        <?php
        foreach ($model->pictures as $picture) {
        ?>
        <div class="thumb <?php echo($picture->cover == 1 ? 'active' : ''); ?>">
            <?php
            echo CHtml::image($picture->thumbnail(), '', ['style' => "width: 64px; cursor: pointer;"]);

            echo CHtml::link(
                '<span class="glyphicon glyphicon-trash"></span>',
                '#',
                [
                    'style' => 'position: relative; top: 10px;',
                    'title' => 'Удалить',
                    'class' => 'btn btn-xs btn-danger pull-right',
                    'submit' => ['deletePicture', 'productPictureID' => $picture->productPictureID],
                    'confirm' => 'Вы уверены?',
                    'params' => ['YII_CSRF_TOKEN' => Yii::app()->request->csrfToken],
                ]);

            echo CHtml::link(
                '<span class="glyphicon glyphicon-picture"></span>',
                ['setCover', 'pictureID' => $picture->productPictureID, 'id' => $model->productID],
                [
                    'style' => 'position: relative; top: 10px; right: 4px;',
                    'title' => 'Сделать главной',
                    'class' => 'btn btn-xs btn-info pull-right',
                ]);

            echo '</div>';
            }
            ?>
        </div>
    </div>

    <script type="text/javascript">
        $('.myProduct-thumbnails img').click(function (){
            $('#mainPicture').attr('src', $(this).attr('src'));
        });
    </script>

    <?php
    $form = $this->beginWidget('CActiveForm', [
        'action' => ['update', 'id' => $model->productID],
        'id' => 'product-form',
        'enableAjaxValidation' => true,
        'clientOptions' => ['validateOnSubmit' => true],
        'htmlOptions' => [
            'class' => 'form-horizontal',
            'role' => 'form',
        ],
    ]);
    ?>
    <div class="col-md-5">
        <div class="form-group">
            <?php
            echo $form->labelEx($model, 'name');
            echo $form->textField($model, 'name', [
                'class' => 'form-control',
                'title' => $model->getAttributeLabel('name'),
            ]);
            echo $form->error($model, 'name');
            ?>
        </div>

        <div class="form-group">
            <?php
            echo $form->labelEx($model, 'description');
            echo $form->textArea($model, 'description', [
                'rows' => 11,
                'class' => 'form-control',
                'title' => $model->getAttributeLabel('description'),
            ]);
            echo $form->error($model, 'description');
            ?>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <?php echo $form->labelEx($model, 'productStatusID', ['class' => 'col-md-3 control-label']); ?>
            <div class="col-md-9">
                <?php
                echo $form->dropDownList($model, 'productStatusID',
                    CHtml::listData(ProductStatus::model()->findAll(), 'productStatusID', 'name'),
                    ['class' => 'form-control', 'title' => $model->getAttributeLabel('productStatusID')]
                );
                echo $form->error($model, 'productStatusID');
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'catalogID', ['class' => 'col-md-3 control-label']); ?>
            <div class="col-md-9">
                <?php
                echo $form->dropDownList($model, 'catalogID',
                    Catalog::dropDownHierarchy(),
                    ['class' => 'form-control', 'title' => $model->getAttributeLabel('catalogID'), 'prompt' => '']
                );
                echo $form->error($model, 'catalogID');
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'unit', ['class' => 'col-md-3 control-label']); ?>
            <div class="col-md-9">
                <?php echo $form->textField($model, 'unit', ['class' => 'form-control']); ?>
                <?php echo $form->error($model, 'unit'); ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'discount', ['class' => 'col-md-3 control-label']); ?>
            <div class="col-md-9">
                <?php
                echo $form->numberField($model, 'discount', [
                    'class' => 'form-control',
                    'title' => $model->getAttributeLabel('discount'),
                    'min' => 0,
                    'max' => '100',
                    'step' => 1,
                ]);
                echo $form->error($model, 'discount');
                ?>
            </div>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'price', ['class' => 'col-md-3 control-label']); ?>
            <div class="col-md-9">
                <?php
                echo $form->numberField($model, 'price',
                    ['class' => 'form-control', 'title' => $model->getAttributeLabel('price'),]
                );
                echo $form->error($model, 'price');
                ?>
            </div>
        </div>


        <div class="form-group">
            <?php echo $form->labelEx($model, 'existence', ['class' => 'col-md-3 control-label']); ?>
            <div class="col-md-9">
                <?php
                echo $form->numberField($model, 'existence', [
                    'class' => 'form-control',
                    'title' => $model->getAttributeLabel('existence'),
                ]);
                echo $form->error($model, 'existence'); ?>
            </div>
        </div>
    </div>
    <?php $this->endWidget(); ?>
</div>
<br>
<h4>Добавление дополнительных картинок</h4>
<form>
    <div id="uploader">
        <p>Ваш браузер не поддерживает ни одну из технологий: Flash, Silverlight, Gears, BrowserPlus, HTML5.</p>
    </div>
</form>


<script type="text/javascript">
    $(function (){
        var uploader = $("#uploader").pluploadQueue({
            runtimes: 'html5,gears,flash,silverlight,browserplus',
            url: '<?php echo $this->createUrl('uploadPicture', ['productID' => $model->productID])?>',
            max_file_size: '8mb',
            unique_names: true,
            resize: {width: 1200, height: 900, quality: 90},
            filters: [
                {title: "Image files", extensions: "jpg,jpeg,gif,png"},
                {title: "Zip files", extensions: "zip"}
            ],
            multipart_params: {
                YII_CSRF_TOKEN: '<?php echo Yii::app()->request->csrfToken;?>'
            },
            flash_swf_url: '/plupload/js/plupload.flash.swf',
            silverlight_xap_url: '/plupload/js/plupload.silverlight.xap'
        });

        $('form').submit(function (e){
            var uploader = $('#uploader').pluploadQueue();
            // Files in queue upload them first
            if(uploader.files.length > 0) {
                // When all files are uploaded submit form
                uploader.bind('StateChanged', function (){
                    if(uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
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