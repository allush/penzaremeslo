<?php /* @var $this FrontController */ ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/front.main.css">

    <script src="/js/jquery-2.0.3.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/page_ini.js"></script>

</head>

<body>

<div class="container">

    <div class="row" id="header">
        <div class="col-md-7">
            <div id="logo">
                <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/img/logo.png'), '/') ?>
            </div>
        </div>

        <div class="col-md-5" id="contacts">

            <p>г.Пенза, ул.Окружная 3, офис ххх</p>
            <p>тел. 8 (8412) 123-456</p>

            <form class="navbar-form  pull-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Поиск">
                </div>
                <button type="submit" class="btn btn-default">Найти</button>
            </form>
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
                    <?php $this->widget('zii.widgets.CMenu', array(
                        'items' => array(
                            array('label' => 'Новости', 'url' => array('/news/index')),
                            array('label' => 'Мастера', 'url' => array('/user/index')),
                            array('label' => 'Каталог', 'url' => array('/product/index')),
                            array('label' => 'О нас', 'url' => array('/about')),
                            array('label' => 'Контакты', 'url' => array('/contacts')),

                            array('label' => 'Вход', 'url' => array('/signIn'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Регистрация', 'url' => array('/signUp'), 'visible' => Yii::app()->user->isGuest),
                            array('label' => 'Мой профиль', 'url' => array('/user/view', 'id' => Yii::app()->user->getState('userID')), 'visible' => !Yii::app()->user->isGuest),
                            array('label' => 'Выйти', 'url' => array('/signOut'), 'visible' => !Yii::app()->user->isGuest),
                        ),
                        'htmlOptions' => array(
                            'class' => 'nav navbar-nav',
                        )
                    )); ?>
                </div>
                <!-- /.navbar-collapse -->
            </nav>
        </div>
    </div>

    <?php if (count($this->breadcrumbs) > 0): ?>
        <div class="row">
            <div class="col-md-12">
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'separator' => ' / ',
                    'htmlOptions' => array(
                        'class' => 'breadcrumb',
                    )
                )); ?>
            </div>
        </div>
    <?php endif ?>

    <div class="row" id='menu'>
        <div class="col-md-12">
            <?php $this->widget('zii.widgets.CMenu', array(
                'items' => $this->menu,
                'htmlOptions' => array(
                    'class' => 'nav nav-pills'
                )
            )); ?>
        </div>
    </div>

    <div class="row" id="content">
        <div class="col-md-12">
            <?php echo $content; ?>
        </div>
    </div>

    <footer class="row" id="footer">
        <div class="col-md-12">
            Copyright &copy; <?php echo date('Y'); ?> by CodeRoom.ru.<br/>
        </div>
    </footer>

</div>

</body>
</html>
