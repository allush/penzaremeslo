<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey
 * Date: 05.10.13
 * Time: 13:52
 * To change this template use File | Settings | File Templates.
 */

class SignInForm extends CFormModel
{

    public $email;
    public $password;
    public $rememberMe = false;

    private $_identity = null;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('email, password', 'required'),
            // email has to be a valid email address
            array('email', 'email'),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
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
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function signIn()
    {
        if ($this->_identity === null) {
            $this->_identity = new FrontUserIdentity($this->email, $this->password);

            $authCode = $this->_identity->authenticate();
            if ($authCode === FrontUserIdentity::ERROR_NOT_ACTIVATED) {
                $this->addError('password', 'Учетная запись не активирована');
            } elseif ($authCode !== true) {
                $this->addError('password', 'Неверный адрес электронной почты или пароль');
            }
        }

        if ($this->_identity->errorCode === FrontUserIdentity::ERROR_NONE) {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            Yii::app()->user->login($this->_identity, $duration);
            return true;
        } else{
            return false;
        }
    }
}