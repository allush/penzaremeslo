<?php /* @var $this FrontController */ ?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?php echo CHtml::encode($this->pageTitle()); ?></title>
    <meta name="description" content="<?php echo CHtml::encode($this->pageDescription()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/front.main.css">
</head>

<body>

<div class="container">

    <div class="row" id="header">
        <div class="col-md-4">
            <div id="logo">
                <?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl . '/img/logo.png'), '/') ?>
            </div>
        </div>

        <div class="col-md-4" id="contacts">

            <p>г.Пенза, ул.Окружная 3, офис ххх</p>

            <p>тел. 8 (8412) 123-456</p>


        </div>

        <div class="col-md-3 col-md-offset-1">
            <?php
            if (Yii::app()->user->isGuest) {
                $model = new SignInForm();
                /** @var CActiveForm $form */
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'login-form',
                    'action' => array('/signIn'),
                    'focus' => array($model, 'email'),
                    'htmlOptions' => array(
                        'role' => 'form',
                    ),
                    'errorMessageCssClass' => 'text-danger'
                )); ?>

                <div class="form-group">
                    <div class="input-group">
                        <span style="width: 100px;" class="span2 input-group-addon">Эл.почта</span>
                        <?php echo $form->textField($model, 'email', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'email'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span style="width: 100px;"
                              class="input-group-addon"><?php echo $model->getAttributeLabel('password') ?></span>
                        <?php echo $form->passwordField($model, 'password', array('class' => 'form-control')); ?>
                        <?php echo $form->error($model, 'password'); ?>
                    </div>
                </div>

                <div class="checkbox">
                    <?php echo $form->label($model, 'rememberMe'); ?>
                    <?php echo $form->checkBox($model, 'rememberMe'); ?>
                    <?php echo $form->error($model, 'rememberMe'); ?>
                </div>

                <div class="form-group" style="line-height: 16px;">
                    <?php echo CHtml::submitButton('Войти', array('style' => 'width: 100px;', 'class' => 'btn btn-default')); ?>
                    <div class="pull-right text-right">
                        <small>
                        <?php echo CHtml::link('Зарегистрироваться', array('/signUp')); ?><br>

                        <?php echo CHtml::link('Восстановить пароль', array('/remind')); ?>
                        </small>
                    </div>
                </div>

                <?php $this->endWidget();

            } else {
                $userID = Yii::app()->user->getState('userID');
                /** @var User $user */
                $user = User::model()->findByPk($userID);
                if ($user) {
                    ?>
                    <div><?php echo CHtml::image($user->photo(), '', array('class' => 'img-rounded','style' => 'height: 96px;')) ?></div>
                    <div><?php echo $user->fullName(); ?></div>

                    <div><?php echo CHtml::link('Мой профиль', array('/user/view', 'id' => $userID)); ?></div>
                    <div><?php echo CHtml::link('Мои товары', array('/myProduct/index')); ?></div>
                    <div><?php echo CHtml::link('Выйти', array('/signOut'), array()); ?></div>
                <?php
                }
            }
            ?>
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
                            array('label' => 'Главная', 'url' => Yii::app()->homeUrl),
                            array('label' => 'Новости', 'url' => array('/news/index')),
                            array('label' => 'Мастера', 'url' => array('/user/index')),
                            array('label' => 'Каталог', 'url' => array('/product/index')),
                            array('label' => 'О нас', 'url' => array('/about')),
                            array('label' => 'Контакты', 'url' => array('/contacts')),
                        ),
                        'htmlOptions' => array(
                            'class' => 'nav navbar-nav',
                        )
                    )); ?>

                    <form class="navbar-form navbar-right" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Поиск">
                        </div>
                        <button type="submit" class="btn btn-default">Найти</button>
                    </form>

                </div>
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
            <div class="well">
                Copyright &copy; <?php echo date('Y'); ?> by <a href="http://coderoom.ru">CodeRoom.ru</a>
            </div>

        </div>
    </footer>

</div>

<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
<script src="/js/bootstrap.min.js"></script>

</body>
</html>
