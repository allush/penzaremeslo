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
}