<?php
/* @var $this ProductController */
/* @var $data Product */
/* @var $itemCount int */


$closed = false;
if ($index % 4 == 0) {
    if ($index > 0) {
//        echo '<div class="clear"></div>';
        echo '</div>';
        $closed = true;
    }
    $closed = false;
    echo '<div class="row">';
}
?>

    <div class="col-md-3 products-item">
        <div class="product-image">
            <?php echo CHtml::link(CHtml::image($data->thumbnail()), array('view', 'id' => $data->productID)); ?>
        </div>
        <div class="name-product">
            <?php echo CHtml::link($data->name, array('view', 'id' => $data->productID)); ?>
        </div>
        <div class="product-price">
            <!--            --><?php //echo CHtml::link('', '', array('class' => 'to-basket-button', 'productID' => $data->productID)); ?>
            <p class="product-to-cart">
                <?php echo CHtml::link('В корзину', '', array('class' => 'to-basket-button', 'productID' => $data->productID)); ?>
            </p>
            <p class="product-price-text" <?php echo ($data->discount > 0) ? "style='color: #FF622B;'" : '' ?>><?php echo $data->priceCurrency(); ?></p>
        </div>
        <!--    <a href="javascript:void(0)" class="new-icon"></a>-->
        <!--    <a href="javascript:void(0)" class="top-icon"></a>-->
        <?php if ($data->discount > 0) { ?>
            <span class="sale-icon"><?php echo $data->discount . '%' ?></span>
        <?php } ?>
    </div>
    <!--.products-item-->

<?php
if ($index + 1 == $itemCount && !$closed) {
//    echo '<div class="clear"></div>';
    echo '</div>';
}

?>