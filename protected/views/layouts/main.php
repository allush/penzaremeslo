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

    <link rel="stylesheet" href="/fancybox/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/fancybox/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen"/>


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
            <p> г. Пенза, ул. Окружная, 3 (Бизнес-инкубатор "Татлин")</p>

            <p>тел. 8 (8412) 29-10-40</p>
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
                    <div class="pull-right text-right">
                        <small>
                            <?php echo CHtml::link('Зарегистрироваться', array('/signUp')); ?><br>

                            <?php echo CHtml::link('Восстановить пароль', array('/remind')); ?>
                        </small>
                    </div>
                    <?php echo CHtml::submitButton('Войти', array('style' => 'width: 100px;', 'class' => 'btn btn-default')); ?>

                </div>

                <?php $this->endWidget();

            } else {
                $userID = Yii::app()->user->getState('userID');
                /** @var User $user */
                $user = User::model()->findByPk($userID);
                if ($user) {
                    ?>
                    <div><?php echo CHtml::image($user->photo(), '', array('class' => 'img-rounded', 'style' => 'height: 96px;')) ?></div>
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

    <div class="well">
        <footer class="row" id="footer">
            <div class="col-md-6">
                &copy; <?php echo date('Y'); ?> developed by <a href="http://allush.github.io">allush</a>
            </div>


            <div class="col-md-6 text-right">

                <!-- Yandex.Metrika informer -->
                <a href="https://metrika.yandex.ru/stat/?id=29371565&amp;from=informer"
                   target="_blank" rel="nofollow"><img
                        src="//bs.yandex.ru/informer/29371565/1_0_FFFFFFFF_EFEFEFFF_0_pageviews"
                        style="width:80px; height:15px; border:0;" alt="Яндекс.Метрика"
                        title="Яндекс.Метрика: данные за сегодня (просмотры)"
                        onclick="try{Ya.Metrika.informer({i:this,id:29371565,lang:'ru'});return false}catch(e){}"/></a>
                <!-- /Yandex.Metrika informer -->

                <!-- Yandex.Metrika counter -->
                <script type="text/javascript">
                    (function (d, w, c) {
                        (w[c] = w[c] || []).push(function () {
                            try {
                                w.yaCounter29371565 = new Ya.Metrika({
                                    id: 29371565,
                                    webvisor: true,
                                    clickmap: true,
                                    trackLinks: true,
                                    accurateTrackBounce: true
                                });
                            } catch (e) {
                            }
                        });

                        var n = d.getElementsByTagName("script")[0],
                            s = d.createElement("script"),
                            f = function () {
                                n.parentNode.insertBefore(s, n);
                            };
                        s.type = "text/javascript";
                        s.async = true;
                        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                        if (w.opera == "[object Opera]") {
                            d.addEventListener("DOMContentLoaded", f, false);
                        } else {
                            f();
                        }
                    })(document, window, "yandex_metrika_callbacks");
                </script>
                <noscript>
                    <div><img src="//mc.yandex.ru/watch/29371565" style="position:absolute; left:-9999px;" alt=""/>
                    </div>
                </noscript>
                <!-- /Yandex.Metrika counter -->
            </div>
        </footer>
    </div>
</div>



<?php Yii::app()->getClientScript()->registerCoreScript('jquery'); ?>
<script src="/js/jquery.scrollto.js"></script>

<script src="/js/bootstrap.min.js"></script>

<script type="text/javascript" src="/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<script type="text/javascript" src="/fancybox/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<script src="/js/frontend.js"></script>

</body>
</html>
