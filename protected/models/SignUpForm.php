<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey
 * Date: 05.10.13
 * Time: 13:51
 * To change this template use File | Settings | File Templates.
 */

class SignUpForm extends CFormModel{

    public $email;
    public $password;
    public $body;
    public $verifyCode;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            // name, email, subject and body are required
            array('name, email, subject, body', 'required'),
            // email has to be a valid email address
            array('email', 'email'),
            // verifyCode needs to be entered correctly
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
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
            'verifyCode'=>'Verification Code',
        );
    }
}