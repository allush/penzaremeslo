<?php
/* @var $this NewsController */
/* @var $model News */

$this->pageTitle = $model->header . ' - Новости';
$this->pageDescription = $model->header;

?>
<style type="text/css">
    .action {
        margin-bottom: 16px;
    }

    .action-header {
        margin-bottom: 4px;
        font-size: 18px;
    }

    .action-header a {
        color: #71c1cf;
    }
</style>

<?php
echo CHtml::link('<= Все новости', array('index'), array('class' => 'btn btn-default'));
?>

<div class="action">
    <div class="action-header"><?php echo $model->header; ?></div>
    <div class="action-content">
        <?php echo $model->content; ?>
    </div>
</div>

<div class="clearfix"></div>

<div style="height: 50px;">
    <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
    <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareType="none"
         data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir,gplus"></div>
</div>
