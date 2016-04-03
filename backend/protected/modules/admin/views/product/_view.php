<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<?php
if ($index == 0) {
    ?>
    <tr>
        <th class="col-md-1"><?php echo CHtml::encode($data->getAttributeLabel('productID')); ?></th>
        <th class="col-md-2">Картинка</th>
        <th class="col-md-2"><?php echo CHtml::encode($data->getAttributeLabel('name')); ?></th>
        <th class="col-md-1"><?php echo CHtml::encode($data->getAttributeLabel('productStatusID')); ?></th>
        <th class="col-md-1"><?php echo CHtml::encode($data->getAttributeLabel('discount')); ?></th>
        <th class="col-md-1"><?php echo CHtml::encode($data->getAttributeLabel('createdOn')); ?></th>
        <th class="col-md-1"><?php echo CHtml::encode($data->getAttributeLabel('modifiedOn')); ?></th>
    </tr>
<?php
}
?>

<tr>
    <td class="col-md-1"><?php echo CHtml::link($data->productID, array('view', 'id' => $data->productID)); ?></td>
    <td class="col-md-2"><?php echo CHtml::link(CHtml::image($data->thumbnail(), '', array('style' => 'height: 80px;')), array('view', 'id' => $data->productID)); ?></td>
    <td class="col-md-2"><?php echo CHtml::link($data->name, array('view', 'id' => $data->productID)); ?></td>
    <td class="col-md-1"><?php echo CHtml::encode(ProductStatus::model()->findByPk($data->productStatusID)->name); ?></td>
    <td class="col-md-1"><?php echo CHtml::encode($data->discount); ?></td>
    <td class="col-md-1">
        <small><?php echo CHtml::encode(date("d/m/Y", $data->createdOn)); ?></small>
    </td>
    <td class="col-md-1">
        <small><?php echo CHtml::encode(date("d/m/Y", $data->modifiedOn)); ?></small>
    </td>
</tr>