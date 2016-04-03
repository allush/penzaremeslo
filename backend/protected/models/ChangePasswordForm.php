<?php
/**
 * Created by JetBrains PhpStorm.
 * User: alexey
 * Date: 25.11.13
 * Time: 12:46
 * To change this template use File | Settings | File Templates.
 */

class ChangePasswordForm extends CFormModel
{
    public $password;
    public $password2;

    /**
     * Declares the validation rules.
     */
    public function rules()
    {
        return array(
            array('password, password2', 'required'),
            array('password, password2', 'length', 'max' => 128, 'min' => 4),
            array('password', 'compare', 'compareAttribute' => 'password2'),
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
            'password' => 'Пароль',
            'password2' => 'Повторите пароль',
        );
    }

    /**
     * @param User $user
     * @return bool
     */
    public function change($user)
    {
        $user->password = User::hashPassword($this->password);
        if ($user->save()) {
            return true;
        }

        return false;
    }
}