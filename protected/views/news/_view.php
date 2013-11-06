<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="action">
    <h3><?php echo CHtml::link($data->header, array('view', 'id' => $data->newsID));?></h3>
    <div class="action-content"><?php echo $data->trimmedContent();?></div>

    <?php
    if(strlen($data->content) > strlen($data->trimmedContent())){
        echo CHtml::link('читать полностью',array('view','id' => $data->newsID), array('class'=>"btn btn-default"));
    }

    ?>
</div>