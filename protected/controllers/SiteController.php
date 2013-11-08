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
            $this->redirect('/');
        }

        $this->pageTitle = 'Регистрация';

        $model = new User();

        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $model->password = User::hashPassword($model->password);
            if ($model->save()) {
                $message = 'Для активации Вашего профиля перейдите по ссылке: http://penzaremeslo.ru/user/activate?c=' . md5($model->email);

                $mailer = new Mailer();
                $mailer->sendMailSimple($model, 'Регистрация на сайте "' . Yii::app()->name . '"', $message);

                Yii::app()->user->setFlash('signUp', true);
                $this->redirect('/');
            }
        }
        $this->render('signUp', array('user' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionSignIn()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect('/');
        }

        $this->pageTitle = 'Вход';

        $model = new SignInForm();

        // collect user input data
        if (isset($_POST['SignInForm'])) {
            $model->attributes = $_POST['SignInForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }
        // display the login form
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