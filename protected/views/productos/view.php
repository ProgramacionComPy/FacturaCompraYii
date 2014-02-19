<?php
$this->breadcrumbs=array(
	'Productos'=>array('index'),
	$model->id_producto,
);

$this->menu=array(
	array('label'=>'Listar Productos','url'=>array('index')),
	array('label'=>'Crear Productos','url'=>array('create')),
	array('label'=>'Actualizar Productos','url'=>array('update','id'=>$model->id_producto)),
	array('label'=>'Borrar Productos','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_producto),'confirm'=>'Está seguro que desea eliminar?')),
	array('label'=>'Administrar Productos','url'=>array('admin')),
);

echo CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/imprimir.png","Imprimir",array("title"=>"Imprimir registro")),"javascript:imprSelec('print')"); ?>

<div id="print"> 
<h1>Viendo Productos #<?php echo $model->id_producto; ?></h1>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id_producto',
		array(
		'name'=>'id_categoria',
		'value'=>$model->categoria->desc_categoria,
		),
		array(
		'name'=>'id_marca',
		'value'=>$model->marca->desc_marca,
		),
		'descripcion',
		'unidad_medida',
		//'estado',
		array(
		'name'=>'id_igv',
		'value'=>($model->idIgv->desc)."%",
		),
		
		array(
		'name'=>'precio_compra',
		'value'=>MyModel::formatoPrecio($model->precio_compra),
		),
		
		array(
		'name'=>'descuento',
		'value'=>($model->descuento)."%",
		),
	),
)); ?>
</div>
<script type="text/javascript">
function imprSelec(print)
{
var ficha=document.getElementById(print);
var ventimp=window.open(' ','popimpr');
ventimp.document.write(ficha.innerHTML);
ventimp.document.close();
ventimp.print();
ventimp.close();
}
</script>