<?php
/**
 * @var $this Controller
 */

$bower = Yii::app()->assetManager->publish('/app/bower_components');
$vendor = Yii::app()->assetManager->publish('/app/vendor');
?>
<!DOCTYPE html>

<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="stylesheet" href="<?= $bower ?>/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type='text/css' href="<?= $vendor ?>/moxiecode/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css">
</head>

<body>
<div class="container" style="margin-top: 8px;">
    <div class="row">
        <div class="col-md-12">
            <nav class="navbar navbar-default" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <?php
                    $this->widget('zii.widgets.CMenu', [
                        'items' => [
                            ['label' => 'Новости', 'url' => ['news/index']],
                            ['label' => 'Товары', 'url' => ['product/index']],
                            ['label' => 'Страницы', 'url' => ['page/index']],
                            ['label' => 'Пользователи', 'url' => ['user/index']],
                            [
                                'label' => '(' . Yii::app()->user->getState('login') . ') Выйти',
                                'url' => ['site/logout'],
                                'visible' => !Yii::app()->user->isGuest,
                            ],
                        ],
                        'htmlOptions' => [
                            'class' => 'nav navbar-nav',
                        ],
                    ]);
                    ?>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
            $this->widget('zii.widgets.CBreadcrumbs', [
                'links' => $this->breadcrumbs,
                'separator' => '<span class="divider"> / </span> ',
                'tagName' => 'ul',
                'htmlOptions' => [
                    'class' => 'breadcrumb',
                ],
            ]);
            ?><!-- breadcrumbs -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div id="submenu">
                <?php
                $this->widget('zii.widgets.CMenu', [
                    'items' => $this->menu,
                    'htmlOptions' => ['class' => 'nav nav-pills'],
                ]);
                ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php echo $content; ?>
        </div>
    </div>

    <?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>

    <script src="<?= $bower?>/ckeditor/ckeditor.js"></script>
    <script src="/src/components/ckfinder/ckfinder.js"></script>

    <script src="<?= $bower ?>/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
    <script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
    <!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
    <script type="text/javascript" src="<?= $vendor ?>/moxiecode/plupload/js/plupload.full.min.js"></script>
    <script type="text/javascript" src="<?= $vendor ?>/moxiecode/plupload/js/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
    <script type="text/javascript" src="<?= $vendor ?>/moxiecode/plupload/js/i18n/ru.js"></script>
</div>
</body>
</html>
