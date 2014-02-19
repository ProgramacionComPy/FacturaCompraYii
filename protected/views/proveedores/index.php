<?php
$this->breadcrumbs=array(
	'Proveedores',
);

$this->menu=array(
	array('label'=>'Crear Proveedores','url'=>array('create')),
	array('label'=>'Administrar Proveedores','url'=>array('admin')),
);
?>

<h1>Proveedores</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
