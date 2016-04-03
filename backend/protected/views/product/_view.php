<?php
/* @var $this ProductController */
/* @var $data Product */
/* @var $itemCount int */


$closed = false;
if ($index % 4 == 0) {
    if ($index > 0) {
        echo '</div>';
        $closed = true;
    }
    $closed = false;
    echo '<div class="row">';
} ?>

    <div class="col-md-3 products-item">
        <div class="product-image">
            <?php echo CHtml::link(CHtml::image($data->thumbnail()), array('view', 'id' => $data->productID)); ?>
        </div>
        <div class="name-product">
            <?php echo CHtml::link($data->name, array('view', 'id' => $data->productID)); ?>
        </div>
        <div class="product-price">
            <p class="product-price-text" <?php echo ($data->discount > 0) ? "style='color: #FF622B;'" : '' ?>><?php echo $data->priceCurrency(); ?></p>

            <?php if ($data->discount > 0) { ?>
                <span class="product-discount">Скидка <?php echo $data->discount . '%' ?></span>
            <?php } ?>
        </div>

    </div>

<?php if ($index + 1 == $itemCount && !$closed) {
    echo '</div>';
} ?>