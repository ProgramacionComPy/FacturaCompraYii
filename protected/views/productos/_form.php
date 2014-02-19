<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'productos-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	)
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->labelEx($model,'id_categoria'); ?> 
	<?php echo $form->dropDownList($model,'id_categoria',Categorias::getListCategorias(),array('empty'=>'seleccione categoria')); ?>

	<?php echo $form->labelEx($model,'id_marca'); ?> 
	<?php echo $form->dropDownList($model,'id_marca',Marcas::getListMarcas(),array('empty'=>'seleccione marca')); ?>

	<?php echo $form->textFieldRow($model,'descripcion',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textFieldRow($model,'unidad_medida',array('class'=>'span5','maxlength'=>80)); ?>

	<?php echo $form->labelEx($model,'id_igv'); ?> 
	<?php echo $form->dropDownList($model,'id_igv',Igv::getListIgv(),array('empty'=>'seleccione igv')); ?>
	

	<?php echo $form->textFieldRow($model,'precio_compra',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'descuento',array('class'=>'span5')); ?>
		<?php //echo $form->labelEx($model,'estado'); ?>
		<?php //echo $form->dropDownList($model,'estado',Productos::getEstado()); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
