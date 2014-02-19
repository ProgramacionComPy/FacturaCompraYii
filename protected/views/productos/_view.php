<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_producto')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_producto),array('view','id'=>$data->id_producto)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_categoria')); ?>:</b>
	<?php echo CHtml::encode($data->categoria->desc_categoria); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_marca')); ?>:</b>
	<?php echo CHtml::encode($data->marca->desc_marca); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descripcion')); ?>:</b>
	<?php echo CHtml::encode($data->descripcion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('unidad_medida')); ?>:</b>
	<?php echo CHtml::encode($data->unidad_medida); ?>
	<br />
	
		<b><?php echo CHtml::encode($data->getAttributeLabel('id_igv')); ?>:</b>
	<?php echo CHtml::encode($data->idIgv->desc); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('precio_compra')); ?>:</b>
	<?php echo CHtml::encode(MyModel::formatoPrecio($data->precio_compra)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento')); ?>:</b>
	<?php echo CHtml::encode($data->descuento); ?>

</div>