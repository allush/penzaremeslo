<?php

class UserController extends FrontController
{
    public function actionActivate($c)
    {
        /** @var $user User */
        $user = User::model()->find(array(
            'condition' => 'MD5(`email`)=:email and (activated=0 OR activated IS NULL)',
            'params' => array(
                ':email' => $c,
            ),
        ));

        if ($user !== null) {
            $user->activated = 1;
            if ($user->save()) {
                Yii::app()->user->setFlash('activated', true);
                $this->redirect(Yii::app()->homeUrl);
            }
        }

        Yii::app()->user->setFlash('activated', false);
        $this->redirect(Yii::app()->homeUrl);
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                if (Yii::app()->request->isAjaxRequest) {
                    Yii::app()->end();
                }
            }
        }
    }

    /**
     * Lists all models.
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return User the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
