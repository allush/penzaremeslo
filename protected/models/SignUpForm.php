<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey
 * Date: 05.10.13
 * Time: 13:52
 * To change this template use File | Settings | File Templates.
 */

class SignUpForm extends CFormModel
{
    public $name;
    public $email;
    public $password;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('name, email, password', 'required'),
            // email has to be a valid email address
            array('email', 'email'),
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
            'name' => 'Имя',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function signUp()
    {
        $user = new User();
        $user->attributes = $this->attributes;

        if ($user->save()) {
            $message = 'Для активации Вашего профиля перейдите по ссылке: ' . Yii::app()->createAbsoluteUrl('/') . '/user/activate?c=' . md5($user->email);

            $mailer = new Mailer();
            $mailer->sendMailSimple($user, 'Регистрация на сайте "' . Yii::app()->name . '"', $message);

            return true;
        }

        foreach ($user->errors as $attribute => $error) {
            $this->addError($attribute, implode(', ', $error));
        }

        return false;
    }
}