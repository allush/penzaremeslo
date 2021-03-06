<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Alexey
 * Date: 25.06.13
 * Time: 18:56
 * To change this template use File | Settings | File Templates.
 */
class FrontController extends CController
{
    public $pageDescription = null;

    public function pageTitle()
    {
        $pageTitle = Yii::app()->name;

        if (strlen($this->pageTitle) > 0) {
            $pageTitle = $this->pageTitle . ' - ' . $pageTitle;
        }

        return $pageTitle;
    }

    public function pageDescription()
    {
        $pageDescription = Yii::app()->name;

        if (strlen($this->pageDescription) > 0) {
            $pageDescription = $this->pageDescription . ' - ' . $pageDescription;
        }

        return $pageDescription;
    }
    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/main';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();
}
