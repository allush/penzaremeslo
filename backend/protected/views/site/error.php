<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle = 'Ошибочка вышла';
?>
<h2>Ошибочка вышла :)</h2>
<div>
    Возможно, такой страницы не существует. Попробуйте перейти
    на <?php echo CHtml::link('главную страницу', Yii::app()->homeUrl) ?> сайта.
</div>

<br>
<br>

<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
    Подробнее
</a>

<div id="collapseOne" class="collapse text-danger">
    <h2>Error <?php echo $code; ?></h2>
    <?php echo CHtml::encode($message); ?>
</div>
