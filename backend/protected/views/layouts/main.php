<?php
/**
 * @var $this FrontController
 */

$bower = Yii::app()->assetManager->publish('/app/bower_components');
$vendor = Yii::app()->assetManager->publish('/app/vendor');
?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <title><?= CHtml::encode($this->pageTitle()); ?></title>
    <meta name="description" content="<?= CHtml::encode($this->pageDescription()); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="en"/>

    <link rel="stylesheet" href="<?= $bower ?>/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $bower ?>/fancyBox/source/jquery.fancybox.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?= $bower ?>/fancyBox/source/helpers/jquery.fancybox-thumbs.css" type="text/css"
          media="screen">
    <link rel="stylesheet" type='text/css' href="<?= $vendor ?>/moxiecode/plupload/js/jquery.plupload.queue/css/jquery.plupload.queue.css">
    <link rel="stylesheet" href="/src/css/front.main.css">
</head>

<body>

<div class="container">

    <div class="row" id="header">
        <div class="col-md-4">
            <div id="logo">
                <?= CHtml::link(CHtml::image('/src/img/logo.png'), '/') ?>
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
                $form = $this->beginWidget('CActiveForm', [
                    'id' => 'login-form',
                    'action' => ['/signIn'],
                    'focus' => [$model, 'email'],
                    'htmlOptions' => [
                        'role' => 'form',
                    ],
                    'errorMessageCssClass' => 'text-danger',
                ]); ?>

                <div class="form-group">
                    <div class="input-group">
                        <span style="width: 100px;" class="span2 input-group-addon">Эл.почта</span>
                        <?= $form->textField($model, 'email', ['class' => 'form-control']); ?>
                        <?= $form->error($model, 'email'); ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <span style="width: 100px;"
                              class="input-group-addon"><?= $model->getAttributeLabel('password') ?></span>
                        <?= $form->passwordField($model, 'password', ['class' => 'form-control']); ?>
                        <?= $form->error($model, 'password'); ?>
                    </div>
                </div>

                <div class="checkbox">
                    <label>
                        <?= $form->checkBox($model, 'rememberMe'); ?>
                        <?= $model->getAttributeLabel('rememberMe'); ?>
                    </label>
                    <?= $form->error($model, 'rememberMe'); ?>
                </div>

                <div class="form-group" style="line-height: 16px;">
                    <div class="pull-right text-right">
                        <small>
                            <?= CHtml::link('Зарегистрироваться', ['/signUp']); ?><br>

                            <?= CHtml::link('Восстановить пароль', ['/remind']); ?>
                        </small>
                    </div>
                    <?= CHtml::submitButton('Войти',
                        ['style' => 'width: 100px;', 'class' => 'btn btn-default']); ?>

                </div>

                <?php $this->endWidget();

            } else {
                $userID = Yii::app()->user->getState('userID');
                /** @var User $user */
                $user = User::model()->findByPk($userID);
                if ($user) {
                    ?>
                    <div><?= CHtml::image($user->photo(), '',
                            ['class' => 'img-rounded', 'style' => 'height: 96px;']) ?></div>
                    <div><?= $user->fullName(); ?></div>

                    <div><?= CHtml::link('Мой профиль', ['/user/view', 'id' => $userID]); ?></div>
                    <div><?= CHtml::link('Мои товары', ['/myProduct/index']); ?></div>
                    <div><?= CHtml::link('Выйти', ['/signOut'], []); ?></div>
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
                    <?php $this->widget('zii.widgets.CMenu', [
                        'items' => [
                            ['label' => 'Главная', 'url' => Yii::app()->homeUrl],
                            ['label' => 'Новости', 'url' => ['/news/index']],
                            ['label' => 'Мастера', 'url' => ['/user/index']],
                            ['label' => 'Каталог', 'url' => ['/product/index']],
                            ['label' => 'О нас', 'url' => ['/about']],
                            ['label' => 'Контакты', 'url' => ['/contacts']],
                        ],
                        'htmlOptions' => [
                            'class' => 'nav navbar-nav',
                        ],
                    ]); ?>

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
                <?php $this->widget('zii.widgets.CBreadcrumbs', [
                    'links' => $this->breadcrumbs,
                    'separator' => ' / ',
                    'htmlOptions' => [
                        'class' => 'breadcrumb',
                    ],
                ]); ?>
            </div>
        </div>
    <?php endif ?>

    <div class="row" id='menu'>
        <div class="col-md-12">
            <?php $this->widget('zii.widgets.CMenu', [
                'items' => $this->menu,
                'htmlOptions' => [
                    'class' => 'nav nav-pills',
                ],
            ]); ?>
        </div>
    </div>

    <div class="row" id="content">
        <div class="col-md-12">
            <?= $content; ?>
        </div>
    </div>

    <div class="well">
        <footer class="row" id="footer">
            <div class="col-sm-4">
                &copy; <?= date('Y'); ?> developed by <a href="http://allush.github.io">allush</a>
            </div>

            <div class="col-sm-4 text-center">
                <?= CHtml::link('Политика конфиденциальности', ['site/policy'])?>
            </div>

            <div class="col-md-4 text-right">

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
                    (function (d, w, c){
                        (w[c] = w[c] || []).push(function (){
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
                            f = function (){
                                n.parentNode.insertBefore(s, n);
                            };
                        s.type = "text/javascript";
                        s.async = true;
                        s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                        if(w.opera == "[object Opera]") {
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

<script src="<?= $bower?>/ckeditor/ckeditor.js"></script>
<script src="/src/components/ckfinder/ckfinder.js"></script>

<script src="<?= $bower ?>/jquery.scrollTo/jquery.scrollTo.min.js"></script>
<script src="<?= $bower ?>/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?= $bower ?>/fancyBox/source/jquery.fancybox.pack.js"></script>
<script src="<?= $bower ?>/fancyBox/source/helpers/jquery.fancybox-thumbs.js"></script>
<script src="/src/js/frontend.js"></script>

<!-- Third party script for BrowserPlus runtime (Google Gears included in Gears runtime now) -->
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
<!-- Load plupload and all it's runtimes and finally the jQuery queue widget -->
<script type="text/javascript" src="<?= $vendor ?>/moxiecode/plupload/js/plupload.full.min.js"></script>
<script type="text/javascript" src="<?= $vendor ?>/moxiecode/plupload/js/jquery.plupload.queue/jquery.plupload.queue.min.js"></script>
<script type="text/javascript" src="<?= $vendor ?>/moxiecode/plupload/js/i18n/ru.js"></script>

</body>
</html>
