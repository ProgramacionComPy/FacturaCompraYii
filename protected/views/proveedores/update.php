<?php
$this->breadcrumbs=array(
	'Proveedores'=>array('index'),
	$model->id_proveedor=>array('view','id'=>$model->id_proveedor),
	'Actualizar',
);

$this->menu=array(
	array('label'=>'Listar Proveedores','url'=>array('index')),
	array('label'=>'Crear Proveedores','url'=>array('create')),
	array('label'=>'Ver Proveedores','url'=>array('view','id'=>$model->id_proveedor)),
	array('label'=>'Administrar Proveedores','url'=>array('admin')),
);
?>

<h1>Actualizar Proveedores <?php echo $model->id_proveedor; ?></h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>