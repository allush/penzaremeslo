<?php
/* @var $this ProductController */
/* @var $data Product */
?>

<?php
if ($index == 0) {
    ?>
    <tr>
        <th>Картинка</th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('name')); ?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('existence')); ?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('price')); ?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('catalogID')); ?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('createdOn')); ?></th>
        <th><?php echo CHtml::encode($data->getAttributeLabel('modifiedOn')); ?></th>
    </tr>
<?php
}
?>

<tr>
    <td><?php echo CHtml::link(CHtml::image($data->thumbnail(), '', array('style' => 'height: 80px;')), array('view', 'id' => $data->productID)); ?></td>
    <td><?php echo CHtml::link($data->name, array('view', 'id' => $data->productID)); ?></td>
    <td><?php echo CHtml::encode($data->existence); ?></td>
    <td><?php echo CHtml::encode($data->price()); ?></td>
    <td><?php echo CHtml::encode(($data->catalog !== null ? $data->catalog->name : '')); ?></td>
    <td>
        <small><?php echo $data->createdOn(); ?></small>
    </td>
    <td>
        <small><?php echo $data->modifiedOn(); ?></small>
    </td>
</tr>