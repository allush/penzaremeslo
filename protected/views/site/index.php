<?php
/* @var $this SiteController */

if (Yii::app()->user->hasFlash('signUp') and Yii::app()->user->getFlash('signUp') == true) {
    ?>
    <div class="alert alert-success">
        <p>Регистрация прошла успешно!</p>

        <p>На указанный адрес электронной почты было выслано письмо с ссылкой для активации профиля.</p>
    </div>
<?php
}

if (Yii::app()->user->hasFlash('activated')) {
    if (Yii::app()->user->getFlash('activated') == true) {
        ?>
        <div class="alert alert-success">
            <p>Профиль активирован!</p>
        </div>
    <?php
    }else{
        ?>
        <div class="alert alert-warning">
            <p>Активация профиля не удалась!</p>
        </div>
    <?php
    }
}
?>


<div class="row">
    <div class="col-md-9">

        <h1>О нас</h1>

        <div>
            about us about us about us about us about us about us about us
            about usabout usabout usabout usabout usabout usabout usabout us
            about usabout usabout usabout usabout usabout usabout usabout usabout us
            about usabout usabout usabout usabout usabout us
        </div>

        <h1>Мастера</h1>

        <div>
            mastersmasters mastersm astersmaste rsmastersmastersmastersm astersmast ersmaste rsmastersmastersma
            stersmast ersmastersmastersmas tersmastersm astersmas tersmasters
        </div>

        <h1>Магазин</h1>

        <div>
            shop shop shop shop shop shop shop shop shop shop shop shop shop
            shop shop shop shop shop shop shop shop shop shop shop shop shop
            shop shop shop shop shop shop shop shop shop shop shop shop shop shop shop shop
        </div>
    </div>
</div>