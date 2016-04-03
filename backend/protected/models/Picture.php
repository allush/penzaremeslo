<?php

/**
 * @property integer $productPictureID
 * @property string $filename
 * @property integer $productID
 * @property integer $cover
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class Picture extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Picture the static model class
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
        return 'picture';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['filename, productID', 'required'],
            ['productID, cover', 'numerical', 'integerOnly' => true],
            ['filename', 'length', 'max' => 255],
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            ['productPictureID, filename, productID', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            'product' => [self::BELONGS_TO, 'Product', 'productID'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'productPictureID' => 'Product Picture',
            'filename' => 'Filename',
            'productID' => 'Product',
            'cover' => 'Обложка',
        ];
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('productPictureID', $this->productPictureID);
        $criteria->compare('filename', $this->filename, true);
        $criteria->compare('productID', $this->productID);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * На исходном изображении поставить водяной знак, сохранив новое изображение как копию
     */
    public function setWatermark()
    {
        $logo_name = '/app/src/img/watermark.png';

        if (!file_exists($logo_name) or !is_file($logo_name)) {
            return false;
        }

        $watermarkPath = '/app' . $this->watermark();

        $largePath = '/app' . $this->large();
        $image = @imagecreatefromjpeg($largePath);

        $w = imagesx($image);
        $h = imagesy($image);

        $logo_img = @imagecreatefrompng($logo_name);
        if ($logo_img) {
            //Высота исходного изоборажения логотипа
            $h_logo_src = imagesy($logo_img);

            //Ищем гипотенузу
            $c = 0;
            $c = sqrt(pow($w, 2) + pow($h, 2));

            //Ищем угол наклона гипотенузы
            $rad_angle = asin($h / $c);
            $deg_angle = rad2deg($rad_angle);

            //Поворачиваем логотип
            $logo_img = imagerotate($logo_img, $deg_angle, imageColorAllocateAlpha($logo_img, 0, 0, 0, 127));

            //Высота логотипа после поворота
            $w_logo = imagesx($logo_img);
            $h_logo = imagesy($logo_img);

            //Кол-во логотипов для данного изображения
            $num_logo = $c / $w_logo;

            //Добавочная высота и ширина
            $d_h = $h_logo_src * abs(sin(deg2rad(90 - $deg_angle)));
            $d_w = -$h_logo_src * abs(cos(deg2rad(90 - $deg_angle)));

            for ($i = 0; $i < $num_logo + 1; $i++) {
                imagecopy($image, $logo_img, $i * $w_logo + ($i + 1) * $d_w - $d_w / 2,
                    $h - ($i + 1) * $h_logo + ($i + 1) * $d_h - $d_h / 2, 0, 0, $w_logo, $h_logo);
            }
        }

        imagejpeg($image, $watermarkPath, 100);
    }


    /**
     * Из большого изображения с водяным знаком создать миниатюру
     */
    public function createThumbnail()
    {
        // создать и сохранить миниатюру
        $ih = new CImageHandler();
        $ih->load('/app' . $this->large())
            ->thumb(400, 300)
            ->save('/app' . $this->thumbnail());
    }

    public function watermark()
    {
        return '/src/img/product/watermark/' . $this->filename;
    }

    public function thumbnail()
    {
        return '/src/img/product/thumbnail/' . $this->filename;
    }

    public function large()
    {
        return '/src/img/product/large/' . $this->filename;
    }

    protected function beforeDelete()
    {
        $base = Yii::app()->basePath . '/..';
        $largePath = $base . $this->large();
        $thumbnailPath = $base . $this->thumbnail();
        $watermarkPath = $base . $this->watermark();

        if (file_exists($largePath)) {
            unlink($largePath);
        }

        if (file_exists($thumbnailPath)) {
            unlink($thumbnailPath);
        }

        if (file_exists($watermarkPath)) {
            unlink($watermarkPath);
        }

        return parent::beforeDelete();
    }
}