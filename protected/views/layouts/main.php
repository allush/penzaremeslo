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

        <div class="col-md-5">
            <h3>Вход/Регистрация</h3>

            <?php
            /** @var CActiveForm $form */
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'login-form',
                'action' => array('/site/signIn'),
                'enableAjaxValidation' => false,
                'htmlOptions' => array(
                    'class' => 'form-horizontal',
                    'role' => 'form'
                ),
            ));
            ?>

            <div class="form-group">
                <?php echo $form->labelEx($this->sigInForm, 'email', array('class' => 'col-md-5 control-label')); ?>
                <div class="col-md-7">
                    <?php echo $form->textField($this->sigInForm, 'email', array('class' => 'form-control')); ?>
                    <?php echo $form->error($this->sigInForm, 'email'); ?>
                </div>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($this->sigInForm, 'password', array('class' => 'col-md-5 control-label')); ?>
                <div class="col-md-7">
                    <?php echo $form->passwordField($this->sigInForm, 'password', array('class' => 'form-control')); ?>
                    <?php echo $form->error($this->sigInForm, 'password'); ?>
                </div>
            </div>

            <div class="form-group">
                    <?php echo CHtml::link('Регистрация',array('/signUp'),array('class'=>'col-md-5 control-label'))?>
                <div class="col-md-7">
                <?php echo CHtml::submitButton('Войти', array('class' => 'btn btn-default form-control')); ?>
                </div>
            </div>

            <?php $this->endWidget(); ?>

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
                            array('label' => 'Главная', 'url' => '/'),
                            array('label' => 'Новости', 'url' => array('/news/index')),
                            array('label' => 'Мастера', 'url' => array('/master/index')),
                            array('label' => 'Каталог', 'url' => array('/product/index')),
                            array('label' => 'О нас', 'url' => array('/about')),
                            array('label' => 'Контакты', 'url' => array('/contacts')),
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


</body>
</html>
