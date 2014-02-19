<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id_producto=>array('view','id'=>$model->id_producto),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Productos','url'=>array('index')),
	array('label'=>'Crear Productos','url'=>array('create')),
	array('label'=>'Ver Productos','url'=>array('view','id'=>$model->id_producto)),
	array('label'=>'Administrar Productos','url'=>array('admin')),
);
?>

<h1>Actualizar Productos <?php echo $model->id_producto; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>