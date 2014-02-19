<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'proveedores-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	)
)); ?>

	<p class="help-block">Campos con <span class="required">*</span> son requeridos.</p>

	<?php echo $form->errorSummary($model); ?>

<?php 
$paises = new CDbCriteria; 
$paises->order = 'desc_pais ASC';
?>

<?php echo $form->labelEx($model,'paises_id_pais'); ?> 
<?php	
echo $form->dropDownList($model,'paises_id_pais',CHtml::listData(Paises::model()->findAll($paises),'id_pais','desc_pais'),
                array(
                    'prompt'=>'Seleccionar Pais',
                    'ajax' => array(
                        'type'=>'POST',
                        'url'=>CController::createUrl('Ciudadanos/updateDepartamentos'), 
                        'dataType'=>'json',
                        'data'=>array('paises_id_pais'=>'js:this.value'),  
                        'success'=>'function(data) {
                            $("#Proveedores_departamentos_id_departamento").html(data.dropDownDepartamentos);   
                        }',
            ))); 
			
			echo $form->labelEx($model,'departamentos_id_departamento'); 			
			if($model->paises_id_pais)
            echo $form->dropDownList($model,'departamentos_id_departamento', CHtml::listData(Departamentos::model()->findAll("paises_id_pais=$model->paises_id_pais"),'id_departamento','desc_departamento'),
                array(
                    'prompt'=>'Seleccionar Departamento',
                    'ajax' => array(
                        'type'=>'POST', 
                        'url'=>CController::createUrl('Ciudadanos/updateCiudades'), 
                        'update'=>'#Proveedores_ciudades_id_ciudad', 
                        'data'=>array('departamentos_id_departamento'=>'js:this.value'),
            ))); 
			else
			    echo $form->dropDownList($model,'departamentos_id_departamento', array('0'=>'Seleccionar Departamento'),
                array(
                    'ajax' => array(
                        'type'=>'POST', 
                        'url'=>CController::createUrl('Ciudadanos/updateCiudades'), 
                        'update'=>'#Proveedores_ciudades_id_ciudad', 
                        'data'=>array('departamentos_id_departamento'=>'js:this.value'),
            ))); 
			
			echo $form->labelEx($model,'ciudades_id_ciudad');  
			if($model->departamentos_id_departamento)
            echo $form->dropDownList($model,'ciudades_id_ciudad', CHtml::listData(Ciudades::model()->findAll("departamentos_id_departamento=$model->departamentos_id_departamento"),'id_ciudad','desc_ciudad'), array('prompt'=>'Seleccionar Ciudad')); 
			else
			echo $form->dropDownList($model,'ciudades_id_ciudad',array('empty'=>'Seleccionar Ciudad'));
			?>

	<?php echo $form->textFieldRow($model,'nombre_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'direccion_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'telefono_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'cell_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'ruc_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'email_proveedor',array('class'=>'span5','maxlength'=>45)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
