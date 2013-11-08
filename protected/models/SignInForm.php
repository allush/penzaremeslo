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
            'password' => 'Пароль'
        );
    }

    /**
     * Logs in the user using the given username and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null) {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE) {
            Yii::app()->user->login($this->_identity, 0);
            return true;
        } else
            return false;
    }
}