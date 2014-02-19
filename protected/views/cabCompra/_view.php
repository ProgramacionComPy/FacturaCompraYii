<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_compra')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_compra),array('view','id'=>$data->id_compra)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->id_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nro_documento')); ?>:</b>
	<?php echo CHtml::encode($data->nro_documento); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_compra')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_compra); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha_registro')); ?>:</b>
	<?php echo CHtml::encode($data->fecha_registro); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user')); ?>:</b>
	<?php echo CHtml::encode($data->user); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_documento')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_documento); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('igv')); ?>:</b>
	<?php echo CHtml::encode($data->igv); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('total')); ?>:</b>
	<?php echo CHtml::encode($data->total); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('obs')); ?>:</b>
	<?php echo CHtml::encode($data->obs); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_tipo_pago')); ?>:</b>
	<?php echo CHtml::encode($data->id_tipo_pago); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('descuento_total')); ?>:</b>
	<?php echo CHtml::encode($data->descuento_total); ?>
	<br />

	*/ ?>

</div>