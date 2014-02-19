<?php

class ProveedoresController extends Controller
{

	public $layout='//layouts/column2';


	public function filters()
    {
 
    }

	
	public function actionView($id)
	{
	$criteria = new CDbCriteria();
	$criteria->condition='id_proveedor=:x';
	$criteria->params=array('x'=>$id);
	$ctacte=ProveedorCtaCte::model()->findAll($criteria);
		$this->render('view',array(
			'model'=>$this->loadModel($id),
			'ctacte'=>$ctacte,
		));
	}


	public function actionCreate()
	{
		$model=new Proveedores;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Proveedores']))
		{
			$model->attributes=$_POST['Proveedores'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_proveedor));
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

		if(isset($_POST['Proveedores']))
		{
			$model->attributes=$_POST['Proveedores'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_proveedor));
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
		$dataProvider=new CActiveDataProvider('Proveedores');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionAdmin()
	{
		$model=new Proveedores('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Proveedores']))
			$model->attributes=$_GET['Proveedores'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	public function actionListarProveedores($term) 
	{
	$criteria = new CDbCriteria;
	$criteria->condition = "LOWER(nombre_proveedor) like LOWER(:term)";
	$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
	$criteria->limit = 30;
	$models = Proveedores::model()->findAll($criteria);	
	$arr = array();
      foreach($models as $model)
      {
        $arr[] = array(
          'label'=>($model->nombre_proveedor),  // valores para el dropdown
          'value'=>($model->nombre_proveedor),  // valor del campo
          'id'=>$model->id_proveedor,            // valor del autocompletado
        );
      }
      echo CJSON::encode($arr);
	}
	
	
	public function loadModel($id)
	{
		$model=Proveedores::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='proveedores-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionGenerarPdf()
	{
	  $session=new CHttpSession;
      $session->open();
	   if(isset($session['proveedores_records']))
               {
                $model=$session['proveedores_records'];
               }
               else
			   {
                 $model =Proveedores::model()->findAll();
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
      $mPDF1->Output('Reporte_Proveedores'.date('YmdHis'),'I');	  
	  exit;
	}

		public function actionGenerarPdf2()
	{
	  //Aquí es donde tienen que trabajar, tienen que crear una consulta personalizada, por eso utilizo este método nuevo
	  //En mi ejemplo lo que hago es crear un reporte que me va a mostrar los 10 proveedores que más ofertas presentaron
	  //La tabla proveedores está relacionada con la tabla ofertas
	  //t representa a la tabla proveedores, o a la tabla ofertas
	  //Pueden modificar la siguiente consulta según sus necesidades:
	  $criteria=new CDbCriteria;
	  $criteria->select="*,count(t.id_proveedor) as nprov";
	  $criteria->join="inner join ofertas o ON o.id_proveedor=t.id_proveedor";
	  $criteria->group = 't.id_proveedor';
	  $criteria->limit="10";
	  $criteria->order='nprov DESC';
      $model =Proveedores::model()->findAll($criteria);     
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
      $mPDF1->Output('Reporte_Proveedores'.date('YmdHis'),'I');	  
	  exit;
	}	
	
}
