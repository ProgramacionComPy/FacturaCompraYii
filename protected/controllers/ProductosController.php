<?php

class ProductosController extends Controller
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
		$model=new Productos;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Productos']))
		{
			$model->attributes=$_POST['Productos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_producto));
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

		if(isset($_POST['Productos']))
		{
			$model->attributes=$_POST['Productos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id_producto));
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
		$dataProvider=new CActiveDataProvider('Productos');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	public function actionAdmin()
	{
		$model=new Productos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Productos']))
			$model->attributes=$_GET['Productos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionListarProductos($term) 
	{
	$criteria = new CDbCriteria;
	$criteria->condition = "LOWER(descripcion) like LOWER(:term)";
	$criteria->params = array(':term'=> '%'.$_GET['term'].'%');
	$criteria->limit = 30;
	$models = Productos::model()->findAll($criteria);	
	$arr = array();
      foreach($models as $model)
      {
        $arr[] = array(
          'label'=>($model->descripcion),  // valores para el dropdown
          'value'=>($model->descripcion),  // valor del campo
          'id'=>$model->id_producto,            // valor del autocompletado
        );
      }
      echo CJSON::encode($arr);
	}

	public function loadModel($id)
	{
		$model=Productos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='productos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionGenerarPdf()
	{
	  $session=new CHttpSession;
      $session->open();
	   if(isset($session['productos_records']))
               {
                $model=$session['productos_records'];
               }
               else
			   {
                 $model =Productos::model()->findAll();
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
      $mPDF1->Output('Reporte_Productos'.date('YmdHis'),'I');	  
	  exit;
	}	
	
}
