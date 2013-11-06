<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey
 * Date: 06.11.13
 * Time: 13:27
 * To change this template use File | Settings | File Templates.
 */

class MasterController extends FrontController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => array(
                'order' => 'userID DESC',
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }
}