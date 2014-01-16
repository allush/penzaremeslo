<?php

/**
 * This is the model class for table "catalog".
 *
 * The followings are the available columns in table 'catalog':
 * @property integer $catalogID
 * @property string $name
 * @property integer $parent
 *
 * The followings are the available model relations:
 * @property Product[] $products
 */
class Catalog extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Catalog the static model class
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
        return 'catalog';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name', 'required'),
            array('name', 'unique'),
            array('parent', 'numerical', 'integerOnly' => true),
            array('name', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('catalogID, name, parent', 'safe', 'on' => 'search'),
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
            'products' => array(self::HAS_MANY, 'Product', 'catalogID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'catalogID' => 'ID',
            'name' => 'Название',
            'parent' => 'Родительский каталог',
        );
    }


    protected function beforeDelete()
    {
        Product::model()->updateAll(
            array(
                'catalogID' => null
            ),
            array(
                'condition' => 'catalogID=:catalogID',
                'params' => array(
                    ':catalogID' => $this->catalogID,
                )
            )
        );

        Catalog::model()->updateAll(
            array(
                'parent' => null
            ),
            array(
                'condition' => 'parent=:parent',
                'params' => array(
                    ':parent' => $this->catalogID,
                )
            )
        );

        return parent::beforeDelete();
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

        $criteria->compare('catalogID', $this->catalogID);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('parent', $this->parent);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * @return Catalog|null
     */
    public function parent()
    {
        return Catalog::model()->findByPk($this->parent);
    }

    /**
     * @param Catalog $catalog
     * @param Catalog[] $parents
     */
    private function _parents($catalog, &$parents)
    {
        if ($catalog === null) {
            return;
        }

        $parent = $catalog->parent();
        if ($parent) {
            $parents[] = $parent;
        }

        $this->_parents($parent, $parents);
    }

    /**
     * @return Catalog[]
     */
    public function parents()
    {
        $parents = array();

        $this->_parents($this, $parents);

        $parents = array_reverse($parents);

        return $parents;
    }

    /**
     * @return Catalog[]
     */
    public function children()
    {
        return Catalog::model()->findAllByAttributes(array(
            'parent' => $this->catalogID,
        ));
    }

    public static function childrenRecursively(&$catalogIDs, $catalogID)
    {
        $catalogIDs[] = $catalogID;

        /** @var $children Catalog[] */
        $children = Catalog::model()->findAllByAttributes(
            array(
                'parent' => $catalogID,
            )
        );
        foreach ($children as $child) {
            self::childrenRecursively($catalogIDs, $child->catalogID);
        }
    }

    /**
     * @param $mode string 'edit'|another
     * @param $result array
     * @param $parent Catalog|null
     * @return array
     */
    public static function _loadHierarchy(&$result, $mode, $parent = null)
    {
        /** @var $catalogs Catalog[] */
        $catalogs = Catalog::model()->findAllByAttributes(
            array('parent' => ($parent !== null ? $parent->catalogID : null),),
            array('order' => 'name asc')
        );
        foreach ($catalogs as $catalog) {
            // добавляем себя
            $ids = array();
            Catalog::childrenRecursively($ids, $catalog->catalogID);
            $ids = implode(',', $ids);

            // вычислить кол-во ноутовв линейке
            $productCount = Yii::app()->db->createCommand()
                ->select()
                ->from('product')
                ->where('product.catalogID IN (' . $ids . ') AND deleted=0 AND existence>0')
                ->query()
                ->rowCount;

            $catalogArr = array();
            $catalogArr['text'] = '';
            if ($mode == 'edit') {
                $catalogArr['text'] = CHtml::link('<span class="glyphicon glyphicon-edit"></span>', array("/catalog/update", 'id' => $catalog->catalogID), array('data-toggle' => 'tooltip', 'title' => 'Редактировать'));

            }
            $catalogArr['text'] .= ' <span title="Количество товаров в каталоге" class="badge pull-right">' . $productCount . '</span>';
            $catalogArr['text'] .= CHtml::link($catalog->name, array("/product/index", 'c' => $catalog->catalogID));


            $children = array();
            self::_loadHierarchy($children, $mode, $catalog);
            $catalogArr['children'] = $children;
            $result[] = $catalogArr;
            $children = array();
            unset($children);
        }
    }

    public static function hierarchy($mode = 'view')
    {
        $result = array();
        Catalog::_loadHierarchy($result, $mode);
        return $result;
    }


    /**
     * @param array $result
     * @param array $exclude
     * @param int $depth
     * @param Catalog | null $parent
     */
    private static function _dropDownHierarchy(&$result, $exclude = array(), $depth = 0, $parent = null)
    {
        $criteria = new CDbCriteria();
        if ($parent === null) {
            $criteria->addCondition('parent IS NULL');
        } else {
            $criteria->addCondition('parent=:parent');
            $criteria->params = array(
                ':parent' => ($parent !== null ? $parent->catalogID : null),
            );
        }
        $criteria->addNotInCondition('catalogID', $exclude);
        $criteria->order = 'name ASC';

        /** @var $catalogs Catalog[] */
        $catalogs = Catalog::model()->findAll($criteria);

        foreach ($catalogs as $catalog) {
            $d = '';
            for ($i = 0; $i < $depth; $i++) {
                $d .= '- - ';
            }
            $result[$catalog->catalogID] = $d . $catalog->name;

            self::_dropDownHierarchy($result, $exclude, $depth + 1, $catalog);
        }
    }

    /**
     * @param array $exclude Исключить каталоги с указанными идентификаторами
     * @return array
     */
    public static function dropDownHierarchy($exclude = array())
    {
        $result = array();
        Catalog::_dropDownHierarchy($result, $exclude);
        return $result;
    }
}