<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id_producto',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'id_categoria',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'id_marca',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'descripcion',array('class'=>'span5','maxlength'=>150)); ?>

	<?php echo $form->textFieldRow($model,'unidad_medida',array('class'=>'span5','maxlength'=>80)); ?>
	
	<?php echo $form->textFieldRow($model,'id_igv',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'precio_compra',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'descuento',array('class'=>'span5')); ?>

	<?php //echo $form->textFieldRow($model,'estado',array('class'=>'span5','maxlength'=>1)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
