<?php

class UserController extends BackendController
{
    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('User', [
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $model = new User();

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->userID]);
            }
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->save()) {
                $this->redirect(['view', 'id' => $model->userID]);
            }
        }

        $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(['index']);
        }
    }

    public function actionHide($id)
    {
        $this->loadModel($id)->hide();

        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(['index']);
        }
    }
    public function actionShow($id)
    {
        $this->loadModel($id)->show();

        if (!Yii::app()->request->isAjaxRequest) {
            $this->redirect(['index']);
        }
    }

    /**
     * @param integer $id
     * @return User
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }

        return $model;
    }
}
