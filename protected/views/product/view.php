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
        <?php echo CHtml::image($model->thumbnail(), '', array('style' => 'max-width: 290px;')); ?>
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

