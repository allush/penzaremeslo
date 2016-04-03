<?php

class CatalogController extends BackendController
{
    public function filters()
    {
        return [
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
        ];
    }

    public function accessRules()
    {
        return [
            [
                'allow',
                'users' => ['@'],
            ],
            [
                'deny', // deny all users
                'users' => ['*'],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new Catalog;

        if (isset($_POST['Catalog'])) {
            $model->attributes = $_POST['Catalog'];
            if ($model->save()) {
                $this->redirect(['product/index', 'c' => $model->catalogID]);
            }
        }

        $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Catalog'])) {
            $model->attributes = $_POST['Catalog'];
            if ($model->save()) {
                $this->redirect(['product/index', 'c' => $model->catalogID]);
            }
        }

        $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();

        if (!isset($_GET['ajax'])) {
            $this->redirect(['product/index']);
        }
    }

    public function actionIndex()
    {
        $dataProvider = new CActiveDataProvider('Catalog');
        $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param integer $id the ID of the model to be loaded
     * @return Catalog the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        $model = Catalog::model()->findByPk($id);
        if ($model === null) {
            throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model;
    }
}
