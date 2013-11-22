<?php

class SiteController extends FrontController
{
    public $catalogs = array();

    public function actionAbout()
    {
        $this->breadcrumbs = array(
            'О нас',
        );
        $this->pageTitle = 'О нас';
        /** @var $page Page */
        $page = Page::model()->findByPk(1);
        $this->render('page', array(
            'data' => $page->content,
        ));
    }

    public function actionContacts()
    {
        $this->breadcrumbs = array(
            'Контакты',
        );
        $this->pageTitle = 'Контакты';
        /** @var $page Page */
        $page = Page::model()->findByPk(2);
        $this->render('page', array(
            'data' => $page->content,
        ));
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->catalogs = Catalog::model()->findAll(array(
            'condition' => 'parent IS NULL',
            'order' => 'name ASC'
        ));

        $this->layout = 'catalog';
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    public function actionSignUp()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        }

        $this->pageTitle .= ' - Регистрация';

        $model = new SignUpForm();

        if (isset($_POST['SignUpForm'])) {
            $model->attributes = $_POST['SignUpForm'];
            $model->password = User::hashPassword($model->password);

            if ($model->validate() and $model->signUp()) {
                Yii::app()->user->setFlash('signUp', 'true');
                $this->redirect(Yii::app()->homeUrl);
            }
        }

        $this->render('signUp', array('model' => $model));
    }


    public function actionSignIn()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        }

        $this->pageTitle .= ' - Вход';

        $model = new SignInForm();

        if (isset($_POST['SignInForm'])) {
            $model->attributes = $_POST['SignInForm'];

            if ($model->validate() and $model->signIn()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('signIn', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionSignOut()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}