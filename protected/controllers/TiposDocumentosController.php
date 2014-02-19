<?php

class TiposDocumentosController extends Controller
{

	public $layout='//layouts/column2';


	public function filters()
    {

    }

	
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}


	public function actionCreate()
	{
		$model=new TiposDocumentos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TiposDocumentos']))
		{
			$model->attributes=$_POST['TiposDocumentos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_tipo_documento));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}


	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['TiposDocumentos']))
		{
			$model->attributes=$_POST['TiposDocumentos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_tipo_documento));
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
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}


	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('TiposDocumentos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionAdmin()
	{
		$model=new TiposDocumentos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['TiposDocumentos']))
			$model->attributes=$_GET['TiposDocumentos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}


	public function loadModel($id)
	{
		$model=TiposDocumentos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='tipos-documentos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionGenerarPdf()
	{
	  $session=new CHttpSession;
      $session->open();
	   if(isset($session['tipos_documentos_records']))
               {
                $model=$session['tipos_documentos_records'];
               }
               else
			   {
                 $model =TiposDocumentos::model()->findAll();
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
      $mPDF1->Output('Reporte_TiposDocumentos'.date('YmdHis'),'I');	  
	  exit;
	}	
	
}
