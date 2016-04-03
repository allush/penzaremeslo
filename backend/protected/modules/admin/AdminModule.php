<?php

class AdminModule extends CWebModule
{

    public function init()
    {
        parent::init();

        $this->layout = 'main';

        $this->defaultController = 'news';

        $this->setImport([
            'admin.models.*',
            'admin.components.*',
            'admin.controllers.*',
        ]);

        $this->setModules([
            'gii' => [
                'class' => 'system.gii.GiiModule',
                'password' => 'penzaremeslo',
                // If removed, Gii defaults to localhost only. Edit carefully to taste.
                'ipFilters' => ['127.0.0.1', '::1'],
            ],
        ]);


        Yii::app()->homeUrl = '/admin';
        Yii::app()->setComponents([
            'errorHandler' => [
                'class' => 'CErrorHandler',
                'errorAction' => $this->getId() . '/site/error',
            ],
            'user' => [
                'class' => 'CWebUser',
                'stateKeyPrefix' => 'admin',
                'loginUrl' => Yii::app()->createUrl('admin/site/login'),
            ],
        ], false);
    }

    /**
     * @return the current version.
     */
    public function getVersion()
    {
        return '1.0';
    }
}