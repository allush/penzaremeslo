<?php

class ProductController extends FrontController
{
    const SORTING_PRICE_ASC = 1;
    const SORTING_PRICE_DESC = 2;
    const SORTING_NAME_ASC = 3;
    const SORTING_NAME_DESC = 4;
    const SORTING_AUTHOR_ASC = 5;
    const SORTING_AUTHOR_DESC = 6;
    const SORTING_DATE_ASC = 7;
    const SORTING_DATE_DESC = 8;

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
     * @param null $c
     * @param null $userID
     * @param null $sorting
     * @return CActiveDataProvider
     */
    private function _fetchData($c = null, $userID = null, $sorting = null)
    {
        $criteria = new CDbCriteria();

        if ($c !== null) {
            $c = (int)$c;
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

        if ($userID !== null) {
            $userID = (int)$userID;
            /** @var User $user */
            $user = User::model()->findByPk($userID);
            if ($user !== null) {
                $criteria->addCondition('t.userID=:userID');
                $criteria->params += array(
                    ':userID' => $user->userID,
                );
            }
        }

        if ($sorting !== null) {
            $sorting = (int)$sorting;
            switch ($sorting) {
                case self::SORTING_PRICE_DESC:
                    $criteria->order = 't.price DESC';
                    break;
                case self::SORTING_PRICE_ASC:
                    $criteria->order = 't.price ASC';
                    break;
                case self::SORTING_NAME_DESC :
                    $criteria->order = 't.name DESC';
                    break;
                case self::SORTING_NAME_ASC:
                    $criteria->order = 't.name ASC';
                    break;
                case self::SORTING_AUTHOR_DESC:
                    $criteria->join = 'JOIN user ON user.userID=t.userID';
                    $criteria->order = 'user.name DESC';
                    break;
                case self::SORTING_AUTHOR_ASC:
                    $criteria->join = 'JOIN user ON user.userID=t.userID';
                    $criteria->order = 'user.name ASC';
                    break;
                case self::SORTING_DATE_ASC:
                    $criteria->order = 't.createdOn ASC';
                    break;
                case self::SORTING_DATE_DESC:
                    $criteria->order = 't.createdOn DESC';
                    break;
            }
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

        return $dataProvider;
    }

    public function actionFetchData($c = null, $userID = null, $sorting = null)
    {
        $dataProvider = $this->_fetchData($c, $userID, $sorting);

        $this->renderPartial('_index', array('dataProvider' => $dataProvider));
    }

    /**
     * Lists all models.
     */
    public function actionIndex($c = null, $userID = null, $sorting = null)
    {
        $this->layout = 'catalog';

        $this->pageTitle = 'Каталог';
        $this->breadcrumbs = array(
            'Каталог'
        );

        $dataProvider = $this->_fetchData($c, $userID, $sorting);

        $command = Yii::app()->db->createCommand();
        $users = $command->select('user.userID, CONCAT(user.surname, " ",user.name) as name')
            ->from('product as t')
            ->join('user', 'user.userID=t.userID')
            ->where($dataProvider->criteria->condition, $dataProvider->criteria->params)
            ->order('name')
            ->group('user.userID')
            ->queryAll();

        $authors = array();
        foreach ($users as $user) {
            $authors[$user['userID']] = $user['name'];
        }

        $this->render('index', array(
            'dataProvider' => $dataProvider,
            'authors' => $authors,
            'author' => $userID,
            'sorting' => $sorting
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
