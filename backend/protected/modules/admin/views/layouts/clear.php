<?php
$bower = Yii::app()->assetManager->publish('/app/bower_components');
?>
<!DOCTYPE html>

<html lang="ru">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="language" content="ru"/>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <link rel="stylesheet" href="<?= $bower ?>/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
<div class="row">
    <div class="col-md-3 col-md-offset-4">
        <?php echo $content; ?>
    </div>
</div>

<script src="<?= $bower ?>/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>