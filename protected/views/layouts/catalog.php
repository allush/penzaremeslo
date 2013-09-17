<?php
/* @var $this ProductController ?> */
?>

<?php $this->beginContent('//layouts/main'); ?>

    <div class="row">
        <div class="col-md-6">
            <ul>
                <?php
                foreach ($this->catalogs as $catalog) {
                    /** @var Catalog[] $children */
                    $children = Catalog::model()->findAll(array(
                        'condition' => 'parent=' . $catalog->catalogID,
                        'order' => 'name ASC',
                    ));

                    $childrenID = array();
                    foreach ($children as $child) {
                        $childrenID[] = $child->catalogID;
                    }

                    $active = '';
                    if (is_numeric($_GET['c']) && isset($_GET['c']) && ($_GET['c'] == $catalog->catalogID || in_array($_GET['c'], $childrenID))) {
                        $active = 'active';
                    }
                    echo '<li class="' . $active . '">';

                    echo '<div class="li-wrap">' . CHtml::link($catalog->name, array('/product/index', 'c' => $catalog->catalogID)) . '</div>';


                    if (count($children) > 0) {
                        echo '<ul>';
                        foreach ($children as $child) {
                            echo '<li>';

                            $active = '';
                            if (is_numeric($_GET['c']) && isset($_GET['c']) && $_GET['c'] == $child->catalogID) {
                                $active = 'active';
                            }
                            echo CHtml::link($child->name, array('/product/index', 'c' => $child->catalogID), array('class' => "$active"));
                            echo '</li>';

                        }
                        echo '</ul>';
                    }
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
        <!--.left-sidebar-->
        <div class="col-md-6">
            <?php echo $content; ?>
        </div>
    </div>


<?php $this->endContent(); ?>