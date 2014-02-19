<?php
$this->breadcrumbs=array(
	'Proveedores'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Proveedores','url'=>array('index')),
	array('label'=>'Crear Proveedores','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('proveedores-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Proveedores</h1>

<p>
Si lo desea, puede introducir un operador de comparación (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
o <b>=</b>) al comienzo de cada uno de los valores de su búsqueda para especificar cómo la comparación se debe hacer.
</p>

<?php echo CHtml::link('Búsqueda Avanzada','#',array('class'=>'search-button btn')); ?><?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/pdf.jpg","PDF",array("title"=>"Exportar a PDF")),array("generarpdf")); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'proveedores-grid',
	'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_proveedor',
		array(
		'name'=>'paises_id_pais',
		'value'=>'$data->paises->desc_pais',
		//'filter'=>Ciudades::getListPaises(),
		),
		/*array(
		'name'=>'departamentos_id_departamento',
		'value'=>'$data->departamentos->desc_departamento',
		//'filter'=>Ciudades::getListDepartamentos(),
		),*/
		array(
		'name'=>'ciudades_id_ciudad',
		'value'=>'$data->ciudades->desc_ciudad',
		//'filter'=>Ciudades::getListCiudades(),
		),
		'nombre_proveedor',
		'direccion_proveedor',
		//'telefono_proveedor',
		//'cell_proveedor',
		'ruc_proveedor',
		'email_proveedor',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
