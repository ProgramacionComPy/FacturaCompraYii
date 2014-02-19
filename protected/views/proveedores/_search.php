<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id_proveedor',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'ciudades_id_ciudad',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'departamentos_id_departamento',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'paises_id_pais',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'nombre_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'direccion_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'telefono_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'cell_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'ruc_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'email_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType' => 'submit',
			'type'=>'primary',
			'label'=>'Buscar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
