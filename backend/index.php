<?php
require 'vendor/autoload.php';
require(dirname(__FILE__) . '/vendor/yiisoft/yii/framework/YiiBase.php');

class Yii extends YiiBase
{
    /**
     * @static
     * @return CWebApplication
     */
    public static function app()
    {
        return parent::app();
    }
}

$config = dirname(__FILE__) . '/protected/config/main.php';

Yii::createWebApplication($config)->run();