<?php

/**
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
 * @property string $photo
 * @property string $description
 * @property boolean $isAdmin
 * @property boolean $is_founder
 * @property boolean $hidden
 * @property integer $pos
 *
 */
class User extends CActiveRecord
{
    public $photoFile;

    /**
     * @param string $className active record class name.
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            ['name, email, password', 'required'],
            ['activated, index, createdOn, lastVisit, pos', 'numerical', 'integerOnly' => true],
            ['email', 'unique'],
            ['isAdmin, hidden, is_founder', 'boolean'],
            [
                'surname, name, patronymic, email, password, address, country, phone, region, city, photo',
                'length',
                'max' => 255,
            ],
            [
                'photoFile',
                'file',
                'mimeTypes' => 'image/jpeg',
                'maxSize' => 1024 * 1024 * 2,
                'allowEmpty' => true,
                'tooLarge' => 'Загружаемый файл слишком большой. Максимальный размер - 2 Мб.',
            ],
            ['description', 'safe'],
        ];
    }

    public function relations()
    {
        return [
            'orders' => [self::HAS_MANY, 'Order', 'userID'],
        ];
    }

    public function attributeLabels()
    {
        return [
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
            'photo' => 'Фотография',
            'photoFile' => 'Фотография',
            'is_founder' => 'Учредитель',
            'pos' => 'Позиция',
            'hidden' => 'Скрытый',
        ];
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
        if ($this->hasPhoto()) {
            return '/src/img/user/' . $this->photo;
        }

        return '/src/img/user/photo_no_available.jpg';
    }

    public function hasPhoto()
    {
        $path = '/app/src/img/user/' . $this->photo;
        if (file_exists($path) and is_file($path)) {
            return true;
        }

        return false;
    }

    public function beforeSave()
    {
        /** @var $file CUploadedFile */
        $file = CUploadedFile::getInstance($this, 'photoFile');
        if ($file) {
            $this->photo = md5(crypt(microtime() . $file->getName())) . ".jpg";
            $path = '/app/src/img/user/' . $this->photo;
            if ($file->saveAs($path)) {
                $ih = new CImageHandler();
                $ih->load($path)
                    ->thumb(400, 300)
                    ->save();
            }
        }

        return parent::beforeSave();
    }

    public function isShown()
    {
        return $this->hasPhoto() && $this->activated && !$this->hidden;
    }

    public function hide()
    {
        $this->hidden = 1;
        return $this->save();
    }

    public function show()
    {
        $this->hidden = 0;
        return $this->save();
    }
}