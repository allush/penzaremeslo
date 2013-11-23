<?php

class MyProductController extends FrontController
{
    public function beforeAction($action)
    {
        if (Yii::app()->user->hasState('userID')) {
            return true;
        }

        throw new CHttpException(403, 'You don\'t have permissions to access this page');
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);

        $this->render('view', array(
            'model' => $model
        ));
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Product'])) {
            $model->attributes = $_POST['Product'];
            if ($model->save()) {
                Yii::app()->end();
            }
        }
    }


    public function actionIndex()
    {
        $userID = Yii::app()->user->getState('userID');

        $this->pageTitle = 'Каталог';

        $criteria = new CDbCriteria();
        $criteria->addCondition('userID=:userID AND deleted=:deleted');
        $criteria->params = array(
            ':userID' => $userID,
            ':deleted' => 0
        );

        $dataProvider = new CActiveDataProvider('Product', array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
            'sort' => array(
                'defaultOrder' => 'createdOn DESC'
            ),
        ));

        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionCreate()
    {
        $this->render('create');
    }

    public function actionUpload()
    {
        $userID = Yii::app()->user->getState('userID');

        /** @var $file CUploadedFile */
        $file = CUploadedFile::getInstanceByName('file');

        // создать продукт
        $product = new Product();
        $product->productStatusID = 1;
        $product->userID = $userID;

        // если продукт успешно сохранен
        if ($product->save()) {
            // преобразовать имя файла в уникальное, сохраняя расширение файла
            $originalFilename = $file->getName();
            $fileExtension = strtolower(substr($originalFilename, strripos($originalFilename, '.')));
            $filename = md5(crypt($originalFilename)) . $fileExtension;

            // определение пути сохранения файлов
            $pathLarge = 'img/product/large/' . $filename;

            // если большое изображение успешно сохранено
            if ($file->saveAs($pathLarge)) {
                // создать модель фото продукта
                $picture = new Picture();
                $picture->productID = $product->productID;
                $picture->filename = $filename;
                $picture->save();

                $picture->createThumbnail();

                $picture->setWatermark();
            }
        } else {
            return false;
        }
    }

    public function actionUploadPicture($productID)
    {
        /** @var $file CUploadedFile */
        $file = CUploadedFile::getInstanceByName('file');

        // преобразовать имя файла в уникальное, сохраняя расширение файла
        $originalFilename = $file->getName();
        $fileExtension = strtolower(substr($originalFilename, strripos($originalFilename, '.')));
        $filename = md5(crypt($originalFilename)) . $fileExtension;

        // определение пути сохранения файлов
        $pathLarge = 'img/product/large/' . $filename;

        // если большое изображение успешно сохранено
        if ($file->saveAs($pathLarge)) {

            // создать модель фото продукта
            $picture = new Picture();
            $picture->productID = $productID;
            $picture->filename = $filename;
            $picture->save();

            $picture->createThumbnail();

            $picture->setWatermark();
        }
    }

    public function actionDeletePicture($productPictureID)
    {
        /** @var $picture Picture */
        $picture = Picture::model()->findByPk($productPictureID);

        $base = Yii::app()->basePath . '/..';
        @unlink($base . $picture->large());
        @unlink($base . $picture->thumbnail());
        @unlink($base . $picture->watermark());

        $picture->delete();

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionDelete($id)
    {
        $model = $this->loadModel($id);

        $model->deleted = true;
        $model->save();

        $this->redirect(array('index'));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Product the loaded model
     * @throws CHttpException
     */
    public function loadModel($id)
    {
        /** @var $model Product */
        $model = Product::model()->findByPk($id);
        if ($model === null || $model->deleted)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }
}
