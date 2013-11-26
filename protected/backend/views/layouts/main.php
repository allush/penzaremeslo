<?php /* @var $this Controller */ ?>
<!DOCTYPE html>

<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.min.css'
          type='text/css'>
    <link rel='stylesheet' href='<?php echo Yii::app()->request->baseUrl; ?>/treeview/jquery.treeview.css'
          type='text/css'>

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
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Новости', 'url' => array('/news/index')),
                            array('label' => 'Товары', 'url' => array('/product/index')),
                            array('label' => 'Страницы', 'url' => array('/page/index')),
                            array('label' => 'Пользователи', 'url' => array('/user/index')),
                            array('label' => '(' . Yii::app()->user->getState('login') . ') Выйти', 'url' => array('/site/logout'), 'visible' => !Yii::app()->user->isGuest),
                        ),
                        'htmlOptions' => array(
                            'class' => 'nav navbar-nav',
                        ),
                    ));
                    ?>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <?php
            $this->widget('zii.widgets.CBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'separator' => '<span class="divider"> / </span> ',
                'tagName' => 'ul',
                'htmlOptions' => array(
                    'class' => 'breadcrumb'
                ),
            ));
            ?><!-- breadcrumbs -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="submenu">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'items' => $this->menu,
                    'htmlOptions' => array('class' => 'nav nav-pills'),
                ));
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

    <!--    <script src="//code.jquery.com/jquery.js"></script>-->
    <script type='text/javascript' src='<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.min.js'></script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->request->baseUrl; ?>/treeview/jquery.treeview.js'></script>
    <script type='text/javascript'
            src='<?php echo Yii::app()->request->baseUrl; ?>/treeview/jquery.treeview.edit.js'></script>

</div>

</body>
</html>
