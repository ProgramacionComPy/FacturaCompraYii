<?php
$this->breadcrumbs=array(
	'Compra'=>array('index'),
	'Crear',
);

$this->menu=array(
	array('label'=>'Administrar Compras','url'=>array('index')),
);
?>

<h4>Crear Orden de Compra / Registrar Factura Compra</h4>

<?php echo $this->renderPartial('_form', array(
)); 
?>