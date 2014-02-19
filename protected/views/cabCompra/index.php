<?php
$this->breadcrumbs=array(
	'Cab Compra',
);

$this->menu=array(
	array('label'=>'Listar CabCompra','url'=>array('index')),
	array('label'=>'Crear CabCompra','url'=>array('create')),
);
?>

<h1>Cab Compra</h1>
<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
