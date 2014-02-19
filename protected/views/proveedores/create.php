<?php
$this->breadcrumbs=array(
	'Proveedores'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Listar Proveedores','url'=>array('index')),
	array('label'=>'Administrar Proveedores','url'=>array('admin')),
);
?>

<h1>Crear Proveedores</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>