<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Productos','url'=>array('index')),
	array('label'=>'Administrar Productos','url'=>array('admin')),
);
?>

<h1>Crear Productos</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>