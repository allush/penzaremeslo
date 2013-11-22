<?php
/* @var $this MasterController */
/* @var $data User */
/* @var $itemCount int */

if ($index % 6 == 0) {
    echo '<div class="row">';
}
?>
    <div class="col-md-2 products-item">
        <div class="product-image">
            <?php echo CHtml::link(CHtml::image($data->photo()), array('view', 'id' => $data->userID)); ?>
        </div>
        <div class="name-product">
            <?php echo CHtml::link($data->fullName(), array('view', 'id' => $data->userID)); ?>
        </div>
    </div>
<?php
if (($index + 1) == $itemCount || (($index + 1) % 6) == 0) {
    echo '</div>';
}
