<?php

class UserController extends FrontController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User', [
            'criteria' => [
                'condition' => 'activated=1',
                'order' => 'userID ASC',
            ],
            'pagination' => false,
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionActivate($c)
    {
        /** @var $user User */
        $user = User::model()->find([
            'condition' => 'MD5(`email`)=:email and (activated=0 OR activated IS NULL)',
            'params' => [
                ':email' => $c,
            ],
        ]);

        if($user !== null) {
            $user->activated = 1;
            if($user->save()) {
                Yii::app()->user->setFlash('activated', true);
                $this->redirect(Yii::app()->homeUrl);
            }
        }

        Yii::app()->user->setFlash('activated', false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if(Yii::app()->user->getState('userID') != $model->userID) {
            $this->redirect(['view', 'id' => $model->userID]);
        }

        if(isset($_POST['User'])) {
            $model->attributes = $_POST['User'];

            if($model->save()) {
                $this->redirect(['view', 'id' => $model->userID]);
            }
        }

        $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}
