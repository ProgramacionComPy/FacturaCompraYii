<?php
$this->breadcrumbs=array(
	'Cab Compra'=>array('index'),
	$model->id_compra,
);

$this->menu=array(
	array('label'=>'Listar CabCompra','url'=>array('index')),
	array('label'=>'Crear CabCompra','url'=>array('create')),
);
?>
<h1>Viendo CabCompra #<?php echo $model->id_compra; ?></h1>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id_compra',
		'id_proveedor',
		'nro_documento',
		'fecha_compra',
		'fecha_registro',
		'user',
		'id_tipo_documento',
		'igv',
		'total',
		'obs',
		'id_tipo_pago',
		'descuento_total',
	),
)); ?>