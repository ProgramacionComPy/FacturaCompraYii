<?php

class PagosController extends Controller
{

	public $layout='//layouts/column2';


	public function filters()
    {
      return array(
	  array('CrugeAccessControlFilter')
	  );
    }

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionAddPago()
	{
		if(isset($_POST['id_formapago']) && $_POST['id_formapago']>0)
		{
		//Guardamos el contenido	
		Compra::setPago((int)$_POST['id_formapago']);
		}
		
		if(isset($_POST['tipo_cheque']) && $_POST['tipo_cheque']>0)
		{
		$registro=new RegistroCheque();
		$registro->attributes=array(
									'tipo_cheque_id_tipo_cheque'=>$_POST['tipo_cheque'],
									'bancos_id_banco'=>$_POST['banco'],
									'nro_cheque'=>$_POST['cheque'],
									'titural_cheque'=>$_POST['titular'],
									'importe_cheque'=>10000,
									'fecha_emision'=>$_POST['fecha_emision'],
									'fecha_cobro'=>$_POST['fecha_cobro'],
									);		
			if ($registro->validate()) {
			if(isset($_POST['yt0']))
			unset($_POST['yt0']);
			$cheque[0] = $_POST;
			Compra::setContenidoCheque($cheque);
		    }
		else{
		$error='';
		foreach ($registro->getErrors() as $position => $er)
		$error.=$er[0].'<br/>';
		Yii::app()->user->setFlash('danger',$error);
		}			 
		}		
		$this->redirect(array('/pagos/create'));
	}
	
	public function actionDeletePago()
	{
	Compra::setPago(null);
	$this->redirect(array('/pagos/create'));
	}
	
	public function actionDeleteCheque()
	{
	Compra::setContenidoCheque(array());
	$this->redirect(array('/pagos/create'));
	}


	public function actionCreate()
	{
		$model=new Pagos();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	if(@$pago = Compra::getPago())
	{
		if(isset($_POST['Pagos']))
		{
		
			if($pago==2 && !(@$cheque=Compra::getContenidoCheque()))
			{
			Yii::app()->user->setFlash('danger', '<strong>Complete correctamente los detalles del cheque.</strong>');
			$this->redirect(array('/pagos/create'));	
			}	
			
			$model->attributes=$_POST['Pagos'];
			//Solicitamos el id del ultimo subsidio 
			$id_subsidio=CabSubsidio::getUltimoSubsidio();
			
			if($id_subsidio!=null)
			{
			//Abrimos el modelo CabSubsidio para ver si hay fondos	
			$cabSubsidio=CabSubsidio::model()->findByPk($id_subsidio);
			
			//Preguntamos si el monto actual del subsidio es mayor o igual al importe	
			if($cabSubsidio->monto_actual_subsidio >= $model->importe_pago)
			{
			$model->forma_pago=$pago;
			//Intentamos guardar cambios
			if($model->save())
			{
			//Actualización del Subsidio
			$detSubsidio= new DetSubsidio;
			$detSubsidio->pagos_id_pago=$model->id_pago;
			$detSubsidio->importe_gasto_subsidio=$model->importe_pago;
			$detSubsidio->subsidios_id_subsidio=$cabSubsidio->id_subsidio;
			$detSubsidio->fecha_gasto_subsidio=$model->fecha_pago;
			$cabSubsidio->monto_actual_subsidio-=$model->importe_pago;
			$cabSubsidio->gastos_subsidio+=$model->importe_pago;				
			if($detSubsidio->save() && $cabSubsidio->save()){
						if($model->forma_pago==2){						
						$registro=new RegistroCheque();
						$registro->attributes=array(
									'tipo_cheque_id_tipo_cheque'=>$cheque[0]['tipo_cheque'],
									'bancos_id_banco'=>$cheque[0]['banco'],
									'nro_cheque'=>$cheque[0]['cheque'],
									'titural_cheque'=>$cheque[0]['titular'],
									'importe_cheque'=>$model->importe_pago,
									'fecha_emision'=>$cheque[0]['fecha_emision'],
									'fecha_cobro'=>$cheque[0]['fecha_cobro'],
									'pagos_id_pago'=>$model->id_pago,
									);
						$registro->save();
						}
			Compra::setContenidoCheque(array());
			Compra::setPago(null);			
			}
			$this->redirect(array('view','id'=>$model->id_pago));
			}
			}
			else 
			{
			Yii::app()->user->setFlash('danger', '<strong>No se puede realizar la operacion por falta de fondos</strong>');
			}
			}
			else 
			{
			Yii::app()->user->setFlash('danger', '<strong>No se puede realizar la operacion por falta de fondos</strong>');
			}
		}
	}
		$this->render('create',array(
			'model'=>$model,
		));	
	}


	/*public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Pagos']))
		{
			$model->attributes=$_POST['Pagos'];
			//$cabSubsidio= new CabSubsidio;
			//$cabSubsidio->gastos_subsidio+=$model->importe_pago;
			//$cabSubsidio->monto_actual_subsidio-=$model->importe_pago;
			if($model->save())
			{
			$this->redirect(array('view','id'=>$model->id_pago));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}
	


	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model=$this->loadModel($id);
			
			if($model->fecha_pago == date('Y-m-d'))
			$model->delete();
			
			else
			Yii::app()->user->setFlash('warning', '<strong>No se puede borrar el pago.</strong>');

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
*/

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Pagos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionAdmin()
	{
		$model=new Pagos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Pagos']))
			$model->attributes=$_GET['Pagos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function loadModel($id)
	{
		$model=Pagos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	
	public function loadModelCabSubsidio($id)
	{
		$model=CabSubsidio::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='pagos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionGenerarPdf()
	{
	  $session=new CHttpSession;
      $session->open();
	   if(isset($session['pagos_records']))
               {
                $model=$session['pagos_records'];
               }
               else
			   {
                 $model =Pagos::model()->findAll();
			   }	     
      $mPDF1 = Yii::app()->ePdf->mpdf('utf-8','A4','','',15,15,35,25,9,9,'P');
	  $mPDF1->useOnlyCoreFonts = true;
	  $mPDF1->SetTitle("JuzgadoSys - Reporte");
	  $mPDF1->SetAuthor("JuzgadoSys");
      $mPDF1->SetWatermarkText("JuzgadoSys");
      $mPDF1->showWatermarkText = true;
      $mPDF1->watermark_font = 'DejaVuSansCondensed';
      $mPDF1->watermarkTextAlpha = 0.1;
      $mPDF1->SetDisplayMode('fullpage');
      $mPDF1->WriteHTML($this->renderPartial('pdfReport', array('model'=>$model), true));
      $mPDF1->Output('Reporte_Pagos'.date('YmdHis'),'I');	  
	  exit;
	}	
	
}
