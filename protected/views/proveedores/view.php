<?php
$this->breadcrumbs=array(
	'Proveedores'=>array('index'),
	$model->id_proveedor,
);

$this->menu=array(
	array('label'=>'Listar Proveedores','url'=>array('index')),
	array('label'=>'Crear Proveedores','url'=>array('create')),
	array('label'=>'Actualizar Proveedores','url'=>array('update','id'=>$model->id_proveedor)),
	array('label'=>'Borrar Proveedores','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id_proveedor),'confirm'=>'Está seguro que desea eliminar?')),
	array('label'=>'Administrar Proveedores','url'=>array('admin')),
);

echo CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/imprimir.png","Imprimir",array("title"=>"Imprimir registro")),"javascript:imprSelec('print')"); ?>

<div id="print"> 
<h1>Viendo Proveedores #<?php echo $model->id_proveedor; ?></h1>
<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id_proveedor',
		array(
		'name'=>'paises_id_pais',
		'value'=>$model->paises->desc_pais,
		),
		array(
		'name'=>'departamentos_id_departamento',
		'value'=>$model->departamentos->desc_departamento,
		),
		array(
		'name'=>'ciudades_id_ciudad',
		'value'=>$model->ciudades->desc_ciudad,
		),
		'nombre_proveedor',
		'direccion_proveedor',
		'telefono_proveedor',
		'cell_proveedor',
		'ruc_proveedor',
		'email_proveedor',
	),
)); ?>
<h2>Cuenta Corriente</h2>
<h4>Totales:</h4>
<?php
if($ctacte===null)
{
echo "El proveedor no tiene cuenta corriente";
}
else
{
$debe=$haber=0;
foreach ($ctacte as $row)
{
$debe+=$row->debe;
$haber+=$row->haber;
}
echo "<b>Debe: </b>".MyModel::formatoPrecio($debe);
echo "<br /><b>Haber: </b>".MyModel::formatoPrecio($haber);
echo "<br /><b>Saldo: </b>".MyModel::formatoPrecio(($haber-$debe));
echo "<br /><br />*Saldo negativo (-) significa deuda.";
}
?>
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