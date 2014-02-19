<?php
	class Compra 
	{

		public static function getContenidoCompra() {
			if(is_string(Yii::app()->user->getState('compra')))
				return CJSON::decode(Yii::app()->user->getState('compra'), true);
			else
				return Yii::app()->user->getState('compra');
		}

		public static function setContenidoCompra($compra) {
			return Yii::app()->user->setState('compra', CJSON::encode($compra));
		}
		
		public static function setContenidoCheque($cheque) {
			return Yii::app()->user->setState('cheque', CJSON::encode($cheque));
		}
		
		public static function getContenidoCheque() {
			if(is_string(Yii::app()->user->getState('cheque')))
				return CJSON::decode(Yii::app()->user->getState('cheque'), true);
			else
				return Yii::app()->user->getState('cheque');
		}
		
		public static function getProveedor() {
			return Yii::app()->user->getState('proveedor');
		}

		public static function setProveedor($proveedor) {
			return Yii::app()->user->setState('proveedor', $proveedor);
		}
		
		public static function getPago() {
			return Yii::app()->user->getState('pagoc');
		}

		public static function setPago($pagoc) {
			return Yii::app()->user->setState('pagoc', $pagoc);
		}
		
		public static function getDoc() {
			return Yii::app()->user->getState('doc');
		}

		public static function setDoc($doc) {
			return Yii::app()->user->setState('doc', $doc);
		}

		public static function getTotal($par=false) {
			$total=$iva=$dcto=0;
			if(@$compra=Compra::getContenidoCompra())
			foreach($compra as $product)  {
				//$model=Productos::model()->findByPk($product['id_producto']);				
				//$resultado=ProductoProveedor::getProductoProveedor($model->id_producto);		
				//$subtotal+=@$product['cantidad']*@$product['precio'];
				//$dcto+=(@$product['cantidad']*@$product['precio']*@$product['dcto'])/100;		
				//$iva+=(((@$product['cantidad']*@$product['precio'])-((@$product['cantidad']*@$product['precio']*@$product['dcto'])/100))*@$product['iva'])/100;		
				$precio=(@$product['precio']-((@$product['precio']*@$product['dcto'])/100))*@$product['cantidad'];
				$dcto+=((@$product['precio']*@$product['dcto'])/100)*@$product['cantidad'];			
				$per=1+(@$product['iva']/100);
				$iva+=(float)($precio-($precio/$per));
				$total+=$precio;		
		}		
		if($par==true) return array(
								//'subtotal'=>$subtotal,
								'dcto'=>$dcto,
								'iva'=>$iva,
								'total'=>$total
								);
		else
			return  '  <div class="resumen">
    <h3>RESUMEN</h3>
   <table class="table">
    <tbody>
        <tr>
             <td class="detail-view">
                <table>
				    <tr>
                        <th>TOTAL DESCUENTO:</th>
                        <td class="textright iva">'.$dcto.'</td>
                    </tr>
                    <tr>
                        <th>TOTAL IVA:</th>
                        <td class="textright iva"><span>'.$iva.'</span></td>
                    </tr>
					 <tr>
                        <th>TOTAL A PAGAR:</th>
                        <td class="textright totalgral"><span>'.$total.'</span></td>
                    </tr>	
                </table>
            </td>
        </tr>
    </tbody>
	</table>
    </div>'; 
		}
	
	}
