<?php
$this->breadcrumbs=array(
	'Productos',
);

$this->menu=array(
	array('label'=>'Crear Productos','url'=>array('create')),
	array('label'=>'Administrar Productos','url'=>array('admin')),
);
?>

<h1>Productos</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
