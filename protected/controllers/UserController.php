<?php

class UserController extends FrontController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User', array(
            'criteria' => array(
                'condition' => 'activated=1',
                'order' => 'userID DESC',
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

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

        if (Yii::app()->user->getState('userID') != $model->userID) {
            $this->redirect(array('view', 'id' => $model->userID));
        }

        if (isset($_POST['User'])) {

            $photoExists = $model->photo;

            $model->attributes = $_POST['User'];

            /** @var $files CUploadedFile[] */
            $file = CUploadedFile::getInstanceByName('User[photo]');
            if ($file) {
                $model->photo = md5(crypt($file->getName())) . ".jpg";
            } else {
                $model->photo = $photoExists;
            }

            if ($model->save()) {
                if ($file) {
                    $path = Yii::app()->basePath . '/../img/user/' . $model->photo;
                    $file->saveAs($path);

                    $ih = new CImageHandler();
                    $ih->load($path);

                    $ih->thumb(400, 300)->save();
                }
                $this->redirect(array('view', 'id' => $model->userID));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        if ($model->userID == Yii::app()->user->getState('userID')) {
            $this->menu = array(
                array('label' => 'Редактировать', 'url' => array('update', 'id' => $model->userID)),
            );

            $this->breadcrumbs = array(
                'Мой профиль',
            );
        } else {
            $this->breadcrumbs = array(
                'Мастера' => array('index'),
                $model->fullName(),
            );
        }

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
