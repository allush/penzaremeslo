<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="news">
    <h3><?php echo CHtml::link($data->header, array('view', 'id' => $data->newsID));?></h3>
    <div class="news-createdOn" style="color: #666;font-size: 13px;"><?php echo date('d.m.Y',$data->createdOn);?></div>
    <div class="news-content"><?php echo $data->trimmedContent();?></div>

    <?php
    if(strlen($data->content) > strlen($data->trimmedContent())){
        echo CHtml::link('читать полностью',array('view','id' => $data->newsID), array('class'=>"btn btn-default btn-sm"));
    }
    ?>
</div>