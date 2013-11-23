<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $userID
 * @property string $surname
 * @property string $name
 * @property string $patronymic
 * @property string $email
 * @property string $password
 * @property integer $activated
 * @property string $lastVisit
 * @property string $createdOn
 * @property string $address
 * @property integer $index
 * @property string $country
 * @property string $phone
 * @property string $region
 * @property string $city
 * @property boolean $isAdmin
 * @property string $photo
 * @property string $description
 *
 */
class User extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name, email, password', 'required'),
            array('activated, index, createdOn, lastVisit', 'numerical', 'integerOnly' => true),
            array('email', 'unique'),
            array('isAdmin', 'boolean'),
            array('surname, name, patronymic, email, password, address, country, phone, region, city, photo', 'length', 'max' => 255),
            array('description', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'orders' => array(self::HAS_MANY, 'Order', 'userID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'userID' => 'User',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'email' => 'Электронная почта',
            'password' => 'Пароль',
            'activated' => 'Активирован',
            'lastVisit' => 'Последнее посещение',
            'createdOn' => 'Создан',
            'address' => 'Адрес',
            'index' => 'Индекс',
            'country' => 'Страна',
            'phone' => 'Телефон',
            'region' => 'Регион/область',
            'city' => 'Город',
            'isAdmin' => 'Администратор',
            'description' => 'О себе',
            'photo' => 'Фотография'
        );
    }

    public function fullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * Проверяет пароль пользователя на соответствие введенному в поле
     * @param $password
     * @return bool
     */
    public function validatePassword($password)
    {
        return crypt($password, $this->password) === $this->password;
    }

    /**
     * Создает хэш пароля
     * @param $password
     * @return string
     */
    public static function hashPassword($password)
    {
        return crypt($password, self::generateSalt());
    }

    public static function generateSalt()
    {
        return time();
    }

    public function photo()
    {
        $url = Yii::app()->baseUrl . '/img/user/' . $this->photo;
        $path = Yii::app()->basePath . '/..' . $url;
        if (file_exists($path) and is_file($path)) {
            return $url;
        }

        return Yii::app()->baseUrl . '/img/user/photo_no_available.jpg';
    }
}