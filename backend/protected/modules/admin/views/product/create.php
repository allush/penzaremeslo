<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = [
    'Товары' => ['index'],
    'Добавление новых товаров',
];

$this->renderPartial('_menu');
?>

<form>
    <div id="uploader">
        <p>Ваш браузер не поддерживает ни одну из технологий: Flash, Silverlight, Gears, BrowserPlus, HTML5.</p>
    </div>
</form>

<script type="text/javascript">
    $(function (){
        $("#uploader").pluploadQueue({
            runtimes: 'html5,gears,flash,silverlight,browserplus',
            url: '<?= $this->createUrl('upload')?>',
            max_file_size: '8mb',
            unique_names: true,
            resize: {width: 1200, height: 900, quality: 90},
            filters: [
                {title: "Image files", extensions: "jpg,jpeg,gif,png"},
                {title: "Zip files", extensions: "zip"}
            ],
            multipart_params: {
                YII_CSRF_TOKEN: '<?= Yii::app()->request->csrfToken;?>'
            },
            flash_swf_url: '/plupload/js/plupload.flash.swf',
            silverlight_xap_url: '/plupload/js/plupload.silverlight.xap'
        });


        $('form').submit(function (e){
            var uploader = $('#uploader').pluploadQueue();
            if(uploader.files.length > 0) {
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
