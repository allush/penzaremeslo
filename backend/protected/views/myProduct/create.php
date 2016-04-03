<?php

$this->breadcrumbs = [
    'Мои товары' => ['index'],
    'Добавление новых товаров',
];

$this->menu = [
    ['label' => 'Назад', 'url' => ['index']],
];
?>

<div class="panel panel-danger">
    <div class="panel-heading">Внимание!</div>
    <div class="panel-body">
        <p>Максимальный размер загружаемого изображения: 8 Мб.</p>

        <p>Для каждой загружаемой фотографии будет создан отдельный товар. Добавить дополнительные картинки к товару
            можно при его редактировании.</p>
    </div>
</div>


<form>
    <div id="uploader">
        <p>Ваш браузер не поддерживает ни одну из технологий: Flash, Silverlight, Gears, BrowserPlus, HTML5.</p>
    </div>
</form>

<script type="text/javascript">
    $(function (){
        $("#uploader").pluploadQueue({
            runtimes: 'html5,gears,flash,silverlight,browserplus',
            url: '<?php echo $this->createUrl('upload')?>',
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