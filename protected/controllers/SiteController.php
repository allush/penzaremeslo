<?php

class SiteController extends FrontController
{
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'CCaptchaAction',
            ],
        ];
    }

    public function actionAbout()
    {
        $this->breadcrumbs = [
            'О нас',
        ];
        $this->pageTitle = 'О нас';
        /** @var $page Page */
        $page = Page::model()->findByPk(1);
        $this->render('page', [
            'data' => $page->content,
        ]);
    }

    public function actionContacts()
    {
        $this->breadcrumbs = [
            'Контакты',
        ];
        $this->pageTitle = 'Контакты';
        /** @var $page Page */
        $page = Page::model()->findByPk(2);
        $this->render('page', [
            'data' => $page->content,
        ]);
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        $this->layout = 'catalog';

        $masters = User::model()->findAll([
            'condition' => 'activated=1',
            'order' => 'userID DESC',
            'limit' => 10,
        ]);

        $founders = User::model()->findAll([
            'condition' => 'activated=1 AND is_founder=1 AND pos IS NOT NULL',
            'order' => 'pos ASC',
        ]);

        $products = Product::model()->findAll([
            'condition' => 'price IS NOT NULL AND catalogID IS NOT NULL AND deleted=0 AND existence>0',
            'order' => 'productID DESC',
            'limit' => 4,
        ]);

        $aboutUs = Page::model()->findByPk(1);

        $this->render('index', [
            'aboutUs' => $aboutUs,
            'masters' => $masters,
            'founders' => $founders,
            'products' => $products,
        ]);

    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error = Yii::app()->errorHandler->error) {
            if(Yii::app()->request->isAjaxRequest) {
                echo $error['message'];
            } else {
                $this->render('error', $error);
            }
        }
    }

    public function actionRemind()
    {
        $model = new RemindForm();

        if(isset($_POST['RemindForm'])) {
            $model->attributes = $_POST['RemindForm'];

            if($model->validate() and $model->exist()) {
                Yii::app()->user->setFlash('remind', true);
                Yii::app()->session->add('changePassword', true);
                $this->redirect(Yii::app()->homeUrl);
            }
        }

        $this->render('remind', [
            'model' => $model,
        ]);
    }

    public function actionChangePassword($c)
    {
        // проверяем наличие ключа сессии для возможности смены пароля
        if(Yii::app()->session->get('changePassword') === null) {
            Yii::app()->user->setFlash('error', 'Некорректная ссылка.');
            $this->redirect(Yii::app()->homeUrl);
        }

        // проверяем наличие пользователя
        /** @var User $user */
        $user = User::model()->find('md5(email)=:email', [
            ':email' => $c,
        ]);
        if($user === null) {
            Yii::app()->user->setFlash('error', 'Некорректная ссылка.');
            $this->redirect(Yii::app()->homeUrl);
        }

        $model = new ChangePasswordForm();

        if(isset($_POST['ChangePasswordForm'])) {
            $model->attributes = $_POST['ChangePasswordForm'];

            if($model->validate() and $model->change($user)) {
                Yii::app()->user->setFlash('changePassword', true);
                Yii::app()->session->remove('changePassword');
                $this->redirect(Yii::app()->homeUrl);
            }
        }
        $this->render('changePassword', [
            'model' => $model,
        ]);
    }

    public function actionSignUp()
    {
        if(!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        }

        $this->pageTitle .= ' - Регистрация';

        $model = new SignUpForm();

        if(isset($_POST['SignUpForm'])) {
            $model->attributes = $_POST['SignUpForm'];
            $model->password = User::hashPassword($model->password);

            if($model->validate() and $model->signUp()) {
                Yii::app()->user->setFlash('signUp', 'true');
                $this->redirect(Yii::app()->homeUrl);
            }
        }

        $this->render('signUp', ['model' => $model]);
    }


    public function actionSignIn()
    {
        if(!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
        }

        $this->pageTitle .= ' - Вход';

        $model = new SignInForm();

        if(isset($_POST['SignInForm'])) {
            $model->attributes = $_POST['SignInForm'];

            if($model->validate() and $model->signIn()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('signIn', ['model' => $model]);
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