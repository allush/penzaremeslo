<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
</head>

<body>

<div class="container">

    <div class="row" id="header">
        <div class="col-md-12">
            <div id="logo"><h1><?php echo CHtml::encode(Yii::app()->name); ?></h1></div>
        </div>
    </div>

    <div class="row" id="mainmenu">
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
                    <a class="navbar-brand" href="#"></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <?php
                    $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Главная', 'url' => array('/')),
                            array('label' => 'Новости', 'url' => array('/news/index')),
                            array('label' => 'Мастера', 'url' => array('/master/index')),
                            array('label' => 'Каталог', 'url' => array('/product/index')),
                            array('label' => 'О нас', 'url' => array('/about')),
                            array('label' => 'Контакты', 'url' => array('/contacts')),
                            array('label' => 'Вход', 'url' => array('/signIn'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Выйти (' . Yii::app()->user->name . ')', 'url' => array('/signOut'), 'visible' => !Yii::app()->user->isGuest)
                        ),
                        'htmlOptions' => array(
                            'class' => 'nav navbar-nav',
                        )
                    ));
                    ?>

                    <form class="navbar-form navbar-left pull-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Поиск">
                        </div>
                        <button type="submit" class="btn btn-default">Найти</button>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>

    <?php if (isset($this->breadcrumbs)): ?>
        <div class="row" id="breadcrumbs">
            <div class="col-md-12">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                )); ?>
            </div>
        </div>
    <?php endif ?>

    <div class="row" id="content">
        <div class="col-md-12">
            <?php echo $content; ?>
        </div>
    </div>


    <footer class="row" id="footer">
        <div class="col-md-12">
            Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
            All Rights Reserved.<br/>
            <?php echo Yii::powered(); ?>
        </div>
    </footer>

</div>

<script src="/js/jquery-2.0.3.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</body>
</html>
