<?php Yii::app()->bootstrap->registerAssetCss('bootstrap-box.css');	?>
<div class="row">	
<div class="span3">
<?php $products = Compra::getContenidoCompra(); ?>
	 <div class="bootstrap-widget">
	 <h3>Proveedor</h3>
<div class="form-actions" id="yw3">
	<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'proveedor-form',
	'action'=>$this->createUrl('/cabcompra/addProveedor'),
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	)
)); ?>
	<?php
	if(@$proveedor = Compra::getProveedor())
	{
			if(@$model = Proveedores::model()->findByPk($proveedor))
			{
			echo "<b>Proveedor:</b> ".$model->nombre_proveedor."<br/>";		
			echo CHtml::link('Eliminar', array(
							'/cabcompra/deleteproveedor'));
			}	
	}
	else
	{
    echo CHtml::hiddenField('id_proveedor');
	echo "Seleccione Proveedor";
	$this->widget('zii.widgets.jui.CJuiAutoComplete', array(
	'name'=>'nombre_proveedor',
	'sourceUrl'=>$this->createUrl('/Proveedores/ListarProveedores'),
	'options'=>array(
	'minLength'=>'1',
	'showAnim'=>'fold',
	'select' => 'js:function(event, ui)
	{ jQuery("#id_proveedor").val(ui.item["id"]); }',
	'search'=> 'js:function(event, ui)
	{ jQuery("#id_proveedor").val(0); }'
	),
	'htmlOptions'=>array(
    'class'=>'span2'
    ),
	));		
	$this->widget('bootstrap.widgets.TbButton', array(                      
                        'type' =>'primary',
						'label'=>'Agregar',
                        'buttonType' => 'submit',                        
                )); 
	}			
	?>
	<?php $this->endWidget(); ?>
</div>	<br/>
<h3>Forma de Pago</h3>
<div class="form-actions" id="yw3">
<?php if($products) : ?>
<?php $doc = Compra::getDoc() ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pago-form',
	'action'=>$this->createUrl('/cabcompra/addPago'),
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	)
)); ?>
<?php 
	if(@$pago = Compra::getPago())
	{
			if(@$model = FormasPago::model()->findByPk($pago))
			{
			echo "<b>Forma de Pago:</b> ".$model->desc_forma."<br/>";		
			echo CHtml::link('Eliminar', array('/cabcompra/deletepago'));
			}	
				if($pago==2 && $doc==1)
				{
				echo '<h4>Detalles del Cheque</h4>';
					if(@$cheque= Compra::getContenidoCheque())
					{
					echo '<b>Tipo de cheque:</b> '.TipoCheque::getCheque($cheque[0]['tipo_cheque'])."<br />";
					echo '<b>Banco:</b> '.Bancos::getBanco($cheque[0]['banco'])."<br />";
					echo '<b>Número de cheque:</b> '.$cheque[0]['cheque']."<br />";
					echo '<b>Titular: </b>'.$cheque[0]['titular']."<br />";
					echo '<b>Fecha de Emisión:</b> '.$cheque[0]['fecha_emision']."<br />";
					echo '<b>Fecha de Cobro:</b> '.$cheque[0]['fecha_cobro']."<br />";
					echo CHtml::link('Eliminar Detalles', array('/cabcompra/deletecheque'));
					}
					else{
				echo 'Tipo de cheque: <span class="required">*</span>';
				echo CHtml::dropDownList('tipo_cheque','',TipoCheque::getListCheques(),array('empty'=>'Seleccione Tipo','class'=>'span2'));

				echo '<br />Banco: <span class="required">*</span><br />';
				echo CHtml::dropDownList('banco','',Bancos::getListBancos(),array('empty'=>'Seleccione Banco','class'=>'span2'));

				echo '<br />Titular: <span class="required">*</span><br />';
				echo CHtml::TextField('titular','',array('class'=>'span2'));

				echo '<br />Número de Cheque: <span class="required">*</span><br />';
				echo CHtml::TextField('cheque','',array('class'=>'span2'));

				echo '<br />Fecha de Emision: <span class="required">*</span><br />';
			$this->widget('zii.widgets.jui.CJuiDatePicker',
            array(
            'name'=>'fecha_emision',
			'language' => 'es',
			'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
 'options'=>array(
 'autoSize'=>true,
 'dateFormat'=>'yy-mm-dd',
 'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
 'buttonImageOnly'=>true,
 'buttonText'=>'Fecha',
 'selectOtherMonths'=>true,
 'showAnim'=>'slide',
 'showButtonPanel'=>true,
 'showOn'=>'button',
 'showOtherMonths'=>true,
 'changeMonth' => 'true',
 'changeYear' => 'true',
            ),
			
        )
);
			echo '<br />Fecha de Cobro: <span class="required">*</span>';
			$this->widget('zii.widgets.jui.CJuiDatePicker',
            array(
            'name'=>'fecha_cobro',
			'language' => 'es',
			'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
 'options'=>array(
 'autoSize'=>true,
 'dateFormat'=>'yy-mm-dd',
 'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
 'buttonImageOnly'=>true,
 'buttonText'=>'Fecha',
 'selectOtherMonths'=>true,
 'showAnim'=>'slide',
 'showButtonPanel'=>true,
 'showOn'=>'button',
 'showOtherMonths'=>true,
 'changeMonth' => 'true',
 'changeYear' => 'true',
            ),
			
        )
);
	$this->widget('bootstrap.widgets.TbButton', array(                      
                        'type' =>'primary',
						'label'=>'Agregar detalles',
                        'buttonType' => 'submit',                        
                ));
				}
}
	}
	else
	{
	echo CHtml::dropDownList('id_formapago','',FormasPago::getListFormasPagos(),array('empty'=>'Seleccione forma de pago','class'=>'span2'));
	$this->widget('bootstrap.widgets.TbButton', array(                      
                        'type' =>'primary',
						'label'=>'Agregar',
                        'buttonType' => 'submit',                        
                ));
	}
?>		
<?php $this->endWidget(); ?>	
<?php endif ?>	
</div><br/>	

<?php if($products) : ?>
<h3>Tipo de Documento</h3>
<div class="form-actions" id="yw3">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'doc-form',
	'action'=>$this->createUrl('/cabcompra/addDoc'),
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	)
)); ?>
<?php 
	if($doc)
	{
			if(@$documento = TiposDocumentos::model()->findByPk($doc))
			{
			echo "<b>Tipo de Documento:</b> ".$documento->desc."<br/>";		
			echo CHtml::link('Eliminar', array(
							'/cabcompra/deletedoc'));
			}	
	}
	else
	{
	echo CHtml::dropDownList('id_doc','',TiposDocumentos::getListDocumentos(),array('empty'=>'Seleccione documento','class'=>'span2'));
	$this->widget('bootstrap.widgets.TbButton', array(                      
                        'type' =>'primary',
						'label'=>'Agregar',
                        'buttonType' => 'submit',                        
                ));
	}
?>		
<?php $this->endWidget(); ?>	
</div><br/>	
<h3>Transacción</h3>
<div class="form-actions" id="yw3">
<?php if($pago && $doc) { ?>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'final-form',
	'action'=>$this->createUrl('/cabcompra/complete'),
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	)
)); ?>
<?php 
if($doc==1)
{
echo 'Número de referencia: <span class="required">*</span>';
echo CHtml::TextField('ref','',array('class'=>'span2'));
}

else if($doc==2)
{
echo 'Fecha requerida: <span class="required">*</span>';
$this->widget('zii.widgets.jui.CJuiDatePicker',
            array(
            'name'=>'fecha_requerida',
			'language' => 'es',
			'htmlOptions' => array('readonly'=>"readonly",'class'=>'span2'),
 'options'=>array(
 'autoSize'=>true,
 'dateFormat'=>'yy-mm-dd',
 'buttonImage'=>Yii::app()->baseUrl.'/images/calendar.png',
 'buttonImageOnly'=>true,
 'buttonText'=>'Fecha',
 'selectOtherMonths'=>true,
 'showAnim'=>'slide',
 'showButtonPanel'=>true,
 'showOn'=>'button',
 'showOtherMonths'=>true,
 'changeMonth' => 'true',
 'changeYear' => 'true',
            ),
        )
);
}
echo "Observación:";
echo CHtml::textArea('obs','',array('class'=>'span2'));
?>
<div class="form-actions">
<?php   $this->widget('bootstrap.widgets.TbButton', array(                    
                      		'label'=>'Completar',	
							'type'=>'success',  						
							'buttonType'=>'submit',
                )); 
?>	
</div>
<?php $this->endWidget(); } ?>
<div class="well">
<h4>¿Desea cancelar todas las transacciones?</h4>
<?php   $this->widget('bootstrap.widgets.TbButton', array(    
						'label'=>'Si',
                        'type'=>'danger',						
						'url'=>$this->createUrl('/cabcompra/deleteall'),											
                )); 
?>	
</div>
</div>
<?php endif ?>	

</div>	
</div>	
<div class="span9">	
	<?php $this->widget('bootstrap.widgets.TbAlert', array(
    'alerts'=>array( 
	'success'=>array('block'=>true, 'fade'=>true), 
	'danger'=>array('block'=>true, 'fade'=>true),
    ),
	));?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'productos-form',
	'action'=>$this->createUrl('/cabcompra/addItem'),
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	)
)); ?>
<h4>Buscar Producto</h4>	
<div class="">	
<?php 
	echo CHtml::hiddenField('id_producto',0);
	echo CHtml::hiddenField('cantidad',1);
    $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
	'name'=>'nombre_producto',
	'sourceUrl'=>$this->createUrl('/Productos/ListarProductos'),
	'options'=>array(
	'minLength'=>'1',
	'showAnim'=>'fold',
	'select' => 'js:function(event, ui)
	{ jQuery("#id_producto").val(ui.item["id"]); }',
	'search'=> 'js:function(event, ui)
	{ jQuery("#id_producto").val(0); }'
	),
		 'htmlOptions'=>array(
        'class'=>'span2'
    ),
	));	
?>	
<?php $this->widget('bootstrap.widgets.TbButton', array(
                       'icon' => 'icon-plus',   
					   'label'=>'Agregar Producto',
                       'type' => 'secundary',
                       'buttonType' => 'submit',					   					   
                )); 
?>
</div>	
<?php
	echo '<div class="grid-view">';
	echo '<table class="items table table-striped">';
	echo '<thead>';
	printf('<tr><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th>%s</th><th class="actions button-column">&nbsp;</th></tr>',
			'CANTIDAD',
			'DESCRIPCION',
			'PRECIO UNITARIO',
			'DESC %',
			'IVA %',
			'TOTAL'
			);
	echo '</thead>';
if($products) {

?>
<?php
	echo '<tbody>';
	foreach($products as $position => $product) { 
			printf('<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td class="textright total_'.$position.'">%s</td><td class="actions button-column">%s</td></tr>',					
					CHtml::textField('cantidad_'.$position,
						$product['cantidad'], array(							
							'class' => 'span1 cantidad_'.$position,
							)
						),
					$product['desc'],	
					CHtml::textField('precio_'.$position,
						$product['precio'], array(							
							'class' => 'span2 precio_'.$position,
							)
						),				
					$product['dcto'],
					$product['iva'],
				    (($product['precio']-(($product['precio']*$product['dcto'])/100))*$product['cantidad']),
						$this->widget('bootstrap.widgets.TbButton', array(                      					
						'icon'=>'icon-trash',
						'type'=>'link',						
						'url'=>$this->createUrl('/cabcompra/deleteitem',array('id' => $position)))
						,true)
					);		
					
			Yii::app()->clientScript->registerScript('cantidad_'.$position,"
					$('.cantidad_".$position."').keyup(function() {
						$.ajax({
							url:'".$this->createUrl('/cabcompra/updateCantidad')."',
							data: $('#cantidad_".$position."'),
							success: function(result) {					
							$('.total_".$position."').html(result);	
							$('.resumen').load('".$this->createUrl(
							'/cabcompra/getPrecioTotal')."');
							},
							error: function() {
							},

							});
				});
					");	

			Yii::app()->clientScript->registerScript('precio_'.$position,"
					$('.precio_".$position."').keyup(function() {
						$.ajax({
							url:'".$this->createUrl('/cabcompra/updatePrecio')."',
							data: $('#precio_".$position."'),
							success: function(result) {					
							$('.total_".$position."').html(result);	
							$('.resumen').load('".$this->createUrl(
							'/cabcompra/getPrecioTotal')."');
							},
							error: function() {						
							},

							});
				});
					");	
						
}

echo '</tbody>';

?>



<?php
}
echo '</table><div class="well pull-right extended-summary resumen">';
echo Compra::getTotal(); 
echo '</div></div>';
?>
<br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/>
</div>
</div>
<?php $this->endWidget(); ?>