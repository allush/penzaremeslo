<?php
/* @var $this FrontController ?> */
?>

<?php $this->beginContent('//layouts/main'); ?>

    <div class="row">
        <div class="col-md-3">
            <?php $this->widget('system.web.widgets.CTreeView', [
                'data' => Catalog::hierarchy(),
                'collapsed' => true,
                'unique' => true,
                'persist' => 'location',
                'animated' => 'fast',
            ]); ?>

            <div class="hidden-xs">
                <br>
                <h4>Наши партнеры</h4>
                <a href="http://wimex24.com">
                    <img src="/img/b/wimex.jpg" style="width: 100%; max-width: 300px;">
                </a>
            </div>
        </div>
        <!--.left-sidebar-->
        <div class="col-md-9">
            <?php echo $content; ?>
        </div>
    </div>


<?php $this->endContent(); ?>