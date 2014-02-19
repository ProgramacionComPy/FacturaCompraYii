<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	'Administrar',
);

$this->menu=array(
	array('label'=>'Listar Productos','url'=>array('index')),
	array('label'=>'Crear Productos','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('productos-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Administrar Productos</h1>

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
	'id'=>'productos-grid',
	'type'=>'striped bordered',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id_producto',
		array(
		'name'=>'id_categoria',
		'value'=>'$data->categoria->desc_categoria',
		'filter'=>Categorias::getListCategorias(),
		),
		array(
		'name'=>'id_marca',
		'value'=>'$data->marca->desc_marca',
		'filter'=>Marcas::getListMarcas(),
		),
		'descripcion',
		'unidad_medida',
		/*array(
		'name'=>'estado',
		'filter'=>Productos::getEstado(),
		),*/
		array(
		'name'=>'precio_compra',
		'value'=>'MyModel::formatoPrecio($data->precio_compra)',
		),
		array(
		'name'=>'descuento',
		'value'=>'$data->descuento',
		),
		array(
		'name'=>'id_igv',
		'value'=>'$data->idIgv->desc',
		'filter'=>Igv::getListIgv(),
		),
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
