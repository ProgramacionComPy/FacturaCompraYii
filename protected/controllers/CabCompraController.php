<?php

class CabCompraController extends Controller
{

	public $detallecompra;
	public $layout='//layouts/column1';
	
	
	public function filters()
    {
  
    }
	
	public function actionView($id)
	{
		$this->layout='//layouts/column2';
		$this->render('view',array(
			'model'=>$this->loadModel((int)$id),
		));
	}
		
		public function actionGetPrecioTotal() {
		//Imprimimos el resumen
		echo Compra::getTotal();
		}
		
	private function borrarTodo()
	{
	Compra::setContenidoCompra(array());
	Compra::setProveedor(null);
	Compra::setPago(null);
	Compra::setDoc(null);
	Compra::setContenidoCheque(array());
	}
	
	public function actionUpdateCantidad() 
		{
		//Abrimos el contenido
		$compra= Compra::getContenidoCompra();

		foreach($_GET as $key => $value) 
		 { 
			if(substr($key, 0, 9) == 'cantidad_') 
			{
				if (!is_numeric($value) || $value <= 0 || $value == ' ')
					throw new CException('Cantidad Invalida');
				$position = explode('_', $key);
				$position = $position[1];
				//Si existe cantidad
				if(isset($compra[$position]['cantidad']))
				$compra[$position]['cantidad'] = $value;
				$precio=$compra[$position]['precio']-(($compra[$position]['precio']*$compra[$position]['dcto'])/100);
				//$model = Productos::model()->findByPk($compra[$position]['id_producto']);
				//$resultado=ProductoProveedor::getProductoProveedor($compra[$position]['id_producto']);
					echo $value*$precio;
					//Guardamos el contenido
					return Compra::setContenidoCompra($compra);
			}	
		 }
		}
		
		public function actionUpdatePrecio() 
		{
		//Para actualizar precio
		$compra= Compra::getContenidoCompra();

		foreach($_GET as $key => $value) 
		 { 
			if(substr($key, 0, 7) == 'precio_') 
			{
				if (!is_numeric($value) || $value <= 0 || $value == ' ')
					throw new CException('Precio Invalido');
				$position = explode('_', $key);
				$position = $position[1];
				if(isset($compra[$position]['precio']))
				$compra[$position]['precio'] = $value;
				$precio=$compra[$position]['precio']-(($compra[$position]['precio']*$compra[$position]['dcto'])/100);
					echo $precio*$compra[$position]['cantidad'];
					return Compra::setContenidoCompra($compra);
			}	
		 }
		}
	
	public function actionAddItem()
	{
		//Definimos c como null para comprobación
		$c=null;
		//Abrimos el contenido
		$compra=Compra::getContenidoCompra();	
		
		//Eliminamos los atributos POST innecesarios
		if(isset($_POST['yt0']))
			unset($_POST['yt0']);
		if(isset($_POST['yt1']))
			unset($_POST['yt1']);
		if(isset($_POST['nombre_producto']))
			unset($_POST['nombre_producto']);

		//Consultamos si el existe producto para aumentar la cantidad	
		if($_POST['id_producto']>0)
		{
		if($compra)
		foreach ($compra as $position => $product)
		{
			if($product['id_producto']==$_POST['id_producto'])
			{
			$compra[$position]['cantidad']+=$_POST['cantidad'];
			$c=1;
			}
		}
		//Si no existe producto repetido, se asigna lo mandado por POST
		if($c==null)
		{
		$model = Productos::model()->findByPk($_POST['id_producto']);
		$_POST['desc']= $model->descripcion;
		$_POST['precio']= $model->precio_compra;
		$_POST['dcto']= $model->descuento;
		//Iva en forma manual, se puede cargar de la DB si se desea
		$_POST['iva']= '10';
		$compra[] = $_POST;
		}	
		//Guardamos el contenido	
		Compra::setContenidoCompra($compra);
		
		}
		$this->redirect(array('/cabcompra/create'));
	}
	
	public function actionAddProveedor()
	{
		if($_POST['id_proveedor']>0)
		{
		//Guardamos el contenido	
		Compra::setProveedor((int)$_POST['id_proveedor']);
		}
		$this->redirect(array('/cabcompra/create'));
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
		$this->redirect(array('/cabcompra/create'));
	}
	
		public function actionAddDoc()
	{
		if($_POST['id_doc']>0)
		{
		//Guardamos el contenido	
		Compra::setDoc((int)$_POST['id_doc']);
		}
		$this->redirect(array('/cabcompra/create'));
	}
		
	public function actionCreate()
	{
    $this->render('create',array(
	));	
	}
	
	public function actionComplete()
	{
	//Para guardar todo
		if((@$pago = Compra::getPago()) && (@$doc = Compra::getDoc()) && (@$proveedor=Compra::getProveedor()) && (@$productos=Compra::getContenidoCompra()))
		{
			if($doc==1)
			{
				if($_POST['ref'])
				{
				$referencia=$_POST['ref'];
				$fecha_requerida=null;
				}
				else
				{
				Yii::app()->user->setFlash('danger', '<strong>Complete el numero de referencia.</strong>
				<br/>PD: El numero de referencia es el numero de la factura compra.');		
				$this->redirect(array('/cabcompra/create'));
				}
			}
			else if($doc==2)
			{
				if($_POST['fecha_requerida']>=date('Y-m-d'))
				{
				$referencia=null;
				$fecha_requerida=$_POST['fecha_requerida'];
				}
				else
				{
				Yii::app()->user->setFlash('danger', '<strong>Complete la fecha requerida.</strong>
				<br/>PD: Debe ser mayor o igual a la fecha actual.');
				$this->redirect(array('/cabcompra/create'));
				}
			}
			
			if($pago==2 && !(@$cheque=Compra::getContenidoCheque()))
			{
			Yii::app()->user->setFlash('danger', '<strong>Complete correctamente los detalles del cheque.</strong>');
			$this->redirect(array('/cabcompra/create'));	
			}

			$CabCompra=new CabCompra();
			$resumen=Compra::getTotal(true);
			$CabCompra->attributes=array(
									'id_proveedor'=>$proveedor,
									'fecha_compra'=>date('Y-m-d'),
									'fecha_registro'=>$fecha_requerida,
									'nro_documento'=>$referencia,
									'user'=>Yii::app()->user->name,
									'id_tipo_pago'=>$pago,
									'id_tipo_documento'=>$doc,
									'obs'=>$_POST['obs'],
									//'sub_total'=>$resumen['subtotal'], 
									'igv'=>$resumen['iva'], 
									'total'=>$resumen['total'], 
									'descuento_total'=>$resumen['dcto']
									);								
			if ($CabCompra->validate()) {
				//Guardamos cabecera de compra
				if($CabCompra->save()){				
					//Guardamos detalles de compra
					foreach($productos as $position => $product) {
					$position = new DetalleCompra();				
					$position->id_compra = $CabCompra->id_compra;
					$position->id_producto = $product['id_producto'];
					$position->cantidad_producto = $product['cantidad'];
					$position->precio_unitario = $product['precio'];
					$position->descuento_producto = $product['dcto'];
					$position->subtotal_iva = $product['iva'];
					$position->subtotal_producto =(($product['precio']-(($product['precio']*$product['dcto'])/100))*$product['cantidad']);
					$position->save();		
					}
					$this->borrarTodo();
					Yii::app()->user->setFlash('success', '<strong>Transaccion finalizada correctamente</strong>.');
					$this->redirect(array('/cabcompra/index'));
			 }
		}
		else{
			$error='';
			foreach ($CabCompra->getErrors() as $position => $er)
			$error.=$er[0].'<br/>';
			Yii::app()->user->setFlash('danger',$error);
			$this->redirect(array('/cabcompra/create'));
		}
	}
		Yii::app()->user->setFlash('danger', '<strong>Complete correctamente todos los formularios.</strong>.');
		$this->redirect(array('/cabcompra/create'));
	}	
	
	public function actionDeleteItem($id)
	{
		$id = (int) $id;
		//Descodificamos el array JSON
		$compra = CJSON::decode(Yii::app()->user->getState('compra'), true);
		//Eliminamos el atributo pasado por parámetro
		unset($compra[$id]);
		//Volvemos a codificar y guardar el contenido
		Yii::app()->user->setState('compra', CJSON::encode($compra));
		$this->redirect(array('/cabcompra/create'));
	}
	
	public function actionDeleteProveedor()
	{
	//Para borrar proveedor
	Compra::setProveedor(null);
	$this->redirect(array('/cabcompra/create'));
	}
	
	public function actionDeleteCheque()
	{
	//Para borrar cheque
	Compra::setContenidoCheque(array());
	$this->redirect(array('/cabcompra/create'));
	}
	
	public function actionDeletePago()
	{
	//Para borrar pago
	Compra::setPago(null);
	$this->redirect(array('/cabcompra/create'));
	}
	
	public function actionDeleteDoc()
	{
	//Para borrar tipo de doc
	Compra::setDoc(null);
	$this->redirect(array('/cabcompra/create'));
	}
	
	public function actionDeleteAll()
	{
	//Para borrar todo
	$this->borrarTodo();
    $this->redirect(array('/cabcompra/create'));
	}
	
	public function lookupdata()
	{
		$this->detallecompra=new DetalleCompra('search');
		$this->detallecompra->unsetAttributes();  // clear any default values
		if(isset($_GET['DetalleCompra']))
		$this->detallecompra->attributes=$_GET['DetalleCompra'];
	}

	public function actionIndex()
	{
		$this->layout='//layouts/column2';
		$dataProvider=new CActiveDataProvider('CabCompra');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function loadModel($id)
	{
		$model=CabCompra::model()->findByPk((int)$id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadModeldetail($id)
	{
		$model=DetalleCompra::model()->findAll('id_compra=:id_compra', array(':id_compra'=>(int)$id));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	protected function performAjaxValidation($model)
    {
         if(isset($_POST['ajax']) && $_POST['ajax']==='cabcompra-form')
          {
            echo CActiveForm::validate($model);
            Yii::app()->end();
          }
         if(isset($_POST['ajax']) && $_POST['ajax']==='detcompra-form')
         {
         echo CActiveForm::validate($model);
          Yii::app()->end();
         }
     }
	
}