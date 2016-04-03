<?php

/**
 * @property integer $productID
 * @property string $name
 * @property string $createdOn
 * @property string $modifiedOn
 * @property string $description
 * @property string $unit
 * @property integer $productStatusID
 * @property integer $catalogID
 * @property float $price
 * @property float $purchase
 * @property integer $discount
 * @property integer $existence
 * @property integer $productNumber
 * @property integer $deleted
 * @property integer $group
 * @property integer $views
 * @property integer $userID
 *
 * @property Picture[] $pictures
 * @property ProductStatus $productStatus
 * @property Catalog $catalog
 * @property User $user
 */
class Product extends CActiveRecord
{
    /**
     * @param string $className active record class name.
     * @return Product the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    public function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            ['productStatusID', 'required'],
            [
                'productStatusID, group, catalogID, discount, createdOn, modifiedOn, userID',
                'numerical',
                'integerOnly' => true,
            ],
            ['deleted', 'boolean'],
            ['price, existence, purchase', 'numerical'],
            ['name, unit, productNumber', 'length', 'max' => 255],
            ['description', 'safe'],
            [
                'productID, name, createdOn, modifiedOn, description, unit, productStatusID, discount',
                'safe',
                'on' => 'search',
            ],
        ];
    }

    public function relations()
    {
        return [
            'pictures' => [self::HAS_MANY, 'Picture', 'productID'],
            'productStatus' => [self::BELONGS_TO, 'ProductStatus', 'productStatusID'],
            'catalog' => [self::BELONGS_TO, 'Catalog', 'catalogID'],
            'user' => [self::BELONGS_TO, 'User', 'userID'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'productID' => 'ID',
            'name' => 'Название',
            'createdOn' => 'Создан',
            'modifiedOn' => 'Изменен',
            'description' => 'Описание',
            'unit' => 'Ед.изм.',
            'productStatusID' => 'Статус',
            'catalogID' => 'Каталог',
            'discount' => 'Скидка,%',
            'price' => 'Цена,р',
            'purchase' => 'Закупка,р',
            'existence' => 'Наличие',
            'productNumber' => 'Артикул',
            'group' => 'Группа',
            'views' => 'Количество просмотров',
            'userID' => 'Автор',
        ];
    }

    /**
     * @return CActiveDataProvider
     */
    public function search()
    {
        $criteria = new CDbCriteria;

        $criteria->compare('productID', $this->productID);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('createdOn', $this->createdOn, true);
        $criteria->compare('modifiedOn', $this->modifiedOn, true);
        $criteria->compare('description', $this->description, true);
        $criteria->compare('unit', $this->unit, true);
        $criteria->compare('productStatusID', $this->productStatusID);
        $criteria->compare('discount', $this->discount);
        $criteria->compare('existence', $this->existence);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * @return Picture|null
     */
    public function cover()
    {

        return Picture::model()->find(
            'cover=:cover AND productID=:productID',
            [
                ':cover' => 1,
                ':productID' => $this->productID,
            ]
        );
    }

    /**
     * @return Picture[]|array
     */
    public function additionalPictures()
    {
        return Picture::model()->findAll(
            'cover=:cover AND productID=:productID', [
                ':cover' => 0,
                ':productID' => $this->productID,
            ]
        );
    }

    /**
     * @return null|string
     */
    public function large()
    {
        $cover = $this->cover();

        if ($cover !== null) {
            return $cover->large();
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function watermark()
    {
        $cover = $this->cover();

        if ($cover !== null) {
            return $cover->watermark();
        }

        return null;
    }

    /**
     * @return null|string
     */
    public function thumbnail()
    {
        $cover = $this->cover();

        if ($cover !== null) {
            return $cover->thumbnail();
        }

        return null;
    }


    protected function beforeSave()
    {
        $time = time();
        if ($this->isNewRecord) {
            $this->createdOn = $time;
        }
        $this->modifiedOn = $time;

        return parent::beforeSave();
    }

    /**
     * Стоимость вместе с валютой
     * @return string
     */
    public function priceCurrency()
    {
        return $this->price() . ' руб.';

    }

    public function price()
    {
        $price = $this->price;

        if ($this->discount !== null && $this->discount > 0) {
            $price = round($this->price - ($this->price * $this->discount / 100));
        }
        return $price;
    }

    public function author()
    {
        $author = 'не указан';
        if ($this->user) {
            $author = $this->user->fullName();
        }

        return $author;
    }

    public function createdOn()
    {
        return date('d.m.Y\<\b\r\>H:i:s', $this->createdOn);
    }

    public function modifiedOn()
    {
        return date('d.m.Y\<\b\r\>H:i:s', $this->modifiedOn);
    }

    public function delete()
    {
        $this->deleted = 1;
        return $this->save();
    }
}