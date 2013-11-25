<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey
 * Date: 25.11.13
 * Time: 10:58
 * To change this template use File | Settings | File Templates.
 */
/**
 * @property string $email
 * @property string $verifyCode
 */
class RemindForm extends CFormModel
{
    public $email;
    public $verifyCode;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('email, verifyCode', 'required'),
            // email has to be a valid email address
            array('email', 'email'),
            // авторизованным пользователям код можно не вводить
            array('verifyCode', 'captcha', 'allowEmpty' => !Yii::app()->user->isGuest || !CCaptcha::checkRequirements()),
        );
    }

    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function attributeLabels()
    {
        return array(
            'email' => 'Электронная почта',
            'verifyCode' => 'Код проверки',
        );
    }

    public function exist()
    {
        /** @var User $user */
        $user = User::model()->findByAttributes(array(
            'email' => $this->email,
        ));

        if ($user !== null) {

            $url = Yii::app()->createAbsoluteUrl('site/changePassword', array('c' => md5($user->email)));

            $message = 'Для смены пароля на сайте "' . Yii::app()->name . '" перейдите по ссылке: ' . $url;

            $mailer = new Mailer();
            $mailer->sendMailSimple($user, 'Смена пароля на сайте "' . Yii::app()->name . '"', $message);

            return true;
        }

        $this->addError('email', 'Пользователь с такой почтой не найден');
        return false;
    }
}