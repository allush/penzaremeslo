<?php
/* @var $this SiteController */
/* @var $masters User[] */
/* @var $products Product[] */
/* @var $aboutUs Page */

if (Yii::app()->user->hasFlash('error')) {
    ?>
    <div class="alert alert-danger">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php
}

if (Yii::app()->user->hasFlash('remind') and Yii::app()->user->getFlash('remind') == true) {
    ?>
    <div class="alert alert-success">
        <p>На указанный адрес электронной почты было выслано письмо с ссылкой для восстановления пароля.</p>
    </div>
<?php
}

if (Yii::app()->user->hasFlash('changePassword') and Yii::app()->user->getFlash('changePassword') == true) {
    ?>
    <div class="alert alert-success">
        <p>Пароль успешно изменен.</p>
    </div>
<?php
}

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
    } else {
        ?>
        <div class="alert alert-warning">
            <p>Активация профиля не удалась!</p>
        </div>
    <?php
    }
}
?>


<div class="row">
    <div class="col-md-12">

        <h1 style='margin-top: 0;'>О нас</h1>

        <div class="row">
            <div class="col-md-12">
                <?php echo $aboutUs->trimmedContent(); ?>
            </div>
        </div>

        <h1>Мастера</h1>

        <div class="row">
            <?php
            foreach ($masters as $master) {
                ?>
                <div class="col-md-3 products-item">
                    <div class="product-image">
                        <?php echo CHtml::link(CHtml::image($master->photo()), array('/user/view', 'id' => $master->userID)); ?>
                    </div>
                    <div class="name-product">
                        <?php echo CHtml::link($master->fullName(), array('/user/view', 'id' => $master->userID)); ?>
                    </div>
                    <div class="product-price">

                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <h1>Магазин</h1>

        <div class="row">
            <?php
            foreach ($products as $product) {
                ?>
                <div class="col-md-3 products-item">
                    <div class="product-image">
                        <?php echo CHtml::link(CHtml::image($product->thumbnail()), array('/product/view', 'id' => $product->productID)); ?>
                    </div>
                    <div class="name-product">
                        <?php echo CHtml::link($product->name, array('/product/view', 'id' => $product->productID)); ?>
                    </div>

                    <div class="product-price">
                        <p class="product-price-text" <?php echo ($product->discount > 0) ? "style='color: #FF622B;'" : '' ?>><?php echo $product->priceCurrency(); ?></p>

                        <?php if ($product->discount > 0) { ?>
                            <span class="product-discount">Скидка <?php echo $product->discount . '%' ?></span>
                        <?php } ?>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>