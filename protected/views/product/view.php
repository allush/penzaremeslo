<?php
/* @var $this ProductController */
/* @var $model Product */


$this->breadcrumbs = array(
    'Каталог' => array('index'),
);
foreach ($model->catalog->parents() as $catalog) {
    $this->breadcrumbs[$catalog->name] = array('index', 'c' => $catalog->catalogID);
}
$this->breadcrumbs[$model->catalog->name] = array('index', 'c' => $model->catalogID !== null ? $model->catalogID : -1);
$this->breadcrumbs[] = $model->name;


$this->menu = array(
    array('label' => 'Назад', 'url' => array('index', 'c' => $model->catalogID !== null ? $model->catalogID : -1)),
);
?>

<style type="text/css">
    .product-card h2 {
        margin-top: 0px;;
    }

    .product-card .product-price {
        font-size: 24px;
        color: white;
        background-color: #69A7DD;
        display: inline-block;
        padding: 1px 13px;
        border-radius: 6px;
        border: 1px solid #6D9FCA;
    }

    .product-card .product-price.discount {
        background-color: #F7855E;
        border: 1px solid #D87F61;
    }
</style>

<div class="row product-card">
    <div class="col-md-3 text-center">
        <?php echo CHtml::image($model->thumbnail(), '', array('style' => 'max-width: 290px;')); ?>
    </div>

    <div class="col-md-8 col-md-offset-1">
        <h2><?php echo $model->name; ?></h2>

        <p><?php echo $model->description; ?></p>

        <p>
            <small>Автор: <?php echo $model->user->fullName(); ?></small>
        </p>


        <p class="product-price <?php if ($model->discount > 0) echo 'discount'; ?>">
            <?php echo $model->priceCurrency(); ?>

        </p>

        <?php if ($model->discount > 0) { ?>
            <p style="position: relative;top: -6px;"><small>С учетом скидки <?php echo $model->discount; ?>%</small></p>
        <?php } ?>
    </div>
</div>

