<?php

class ProductController extends FrontController
{
    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $model->views++;
        $model->save();

        $this->pageTitle = 'Каталог - ' . $model->catalog->name . ' - ' . $model->name;

        $this->render('view', array(
            'model' => $model,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($c = null)
    {
        $this->layout = 'catalog';

        $this->pageTitle = 'Каталог';
        $this->breadcrumbs = array(
            'Каталог'
        );

        $criteria = new CDbCriteria();

        if ($c !== null and $c != 0) {

            /** @var Catalog $catalog */
            $catalog = Catalog::model()->findByPk($c);
            if ($catalog !== null) {

                $this->breadcrumbs = array(
                    'Каталог' => array('index'),
                );
                foreach ($catalog->parents() as $parentCatalog) {
                    $this->breadcrumbs[$parentCatalog->name] = array('index', 'c' => $parentCatalog->catalogID);
                }
                $this->breadcrumbs[] = $catalog->name;

                $this->pageTitle = $catalog->name . ' - ' . $this->pageTitle;

                $catalogIDs = array();
                Catalog::childrenRecursively($catalogIDs, $c);
                $criteria->addInCondition('catalogID', $catalogIDs);
                $criteria->addCondition('deleted=0 AND existence>0');
            } else {
                $criteria->condition = 'catalogID IS NOT NULL AND deleted=0 AND existence>0';
            }
        } else {
            $criteria->condition = 'catalogID IS NOT NULL AND deleted=0 AND existence>0';
        }

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
