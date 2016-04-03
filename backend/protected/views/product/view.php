<?php
/* @var $this ProductController */
/* @var $model Product */

$this->breadcrumbs = array(
    'Каталог' => array('index'),
);
foreach ($model->catalog->parents() as $catalog) {
    $this->breadcrumbs[$catalog->name] = array('index', 'c' => $catalog->catalogID);
}
$this->breadcrumbs[$model->catalog->name] = array('index', 'c' => $model->catalogID);
$this->breadcrumbs[] = $model->name;

$this->menu = array(
    array('label' => 'Назад', 'url' => (isset(Yii::app()->request->urlReferrer) ? Yii::app()->request->urlReferrer : array('index', 'c' => $model->catalogID))),
);
?>

<div class="row product-card">
    <div class="col-md-3 text-center">
        <?php echo CHtml::link(CHtml::image($model->thumbnail(), $model->name, array('style' => 'max-width: 260px;')), $model->watermark(), array('class' => 'fancybox', 'rel' => 'group')); ?>

        <?php if (count($model->additionalPictures()) > 0) { ?>
            <div class="row" style="margin-top: 9px;">
                <?php foreach ($model->additionalPictures() as $picture) {
                    echo '<div class="col-md-4" style="margin-bottom: 8px;">' . CHtml::link(CHtml::image($picture->thumbnail(), $picture->product->name, array('style' => 'max-width: 80px; max-height: 60px;')), $picture->watermark(), array('class' => 'fancybox', 'rel' => 'group')) . '</div>';
                } ?>
            </div>
        <?php } ?>
    </div>

    <div class="col-md-8 col-md-offset-1">
        <h2><?php echo $model->name; ?></h2>

        <p><?php echo $model->description; ?></p>

        <p>
            <small>Автор: <?php echo $model->author(); ?></small>
        </p>

        <p class="product-price <?php if ($model->discount > 0) echo 'discount'; ?>"><?php echo $model->priceCurrency(); ?></p>

        <?php if ($model->discount > 0) { ?>
            <p class="product-discount">
                <small>С учетом скидки <?php echo $model->discount; ?>%</small>
            </p>
        <?php } ?>
    </div>
</div>

