<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_proveedor')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id_proveedor),array('view','id'=>$data->id_proveedor)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('paises_id_pais')); ?>:</b>
	<?php echo CHtml::encode($data->paises->desc_pais); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('departamentos_id_departamento')); ?>:</b>
	<?php echo CHtml::encode($data->departamentos->desc_departamento); ?>
	<br />
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudades_id_ciudad')); ?>:</b>
	<?php echo CHtml::encode($data->ciudades->desc_ciudad); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->nombre_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->direccion_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('telefono_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->telefono_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cell_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->cell_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ruc_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->ruc_proveedor); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email_proveedor')); ?>:</b>
	<?php echo CHtml::encode($data->email_proveedor); ?>
	<br />

</div>