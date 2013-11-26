<?php
/* @var $this FrontController ?> */
?>

<?php $this->beginContent('//layouts/main'); ?>

    <div class="row">
        <div class="col-md-3">
            <?php $this->widget('system.web.widgets.CTreeView', array(
                'data' => Catalog::hierarchy(),
                'collapsed' => true,
                'unique' => true,
                'persist' => 'location',
                'animated' => 'fast'
            )); ?>
        </div>
        <!--.left-sidebar-->
        <div class="col-md-9">
            <?php echo $content; ?>
        </div>
    </div>


<?php $this->endContent(); ?>