<?php

/**
 * This is the model class for table "cab_compra".
 *
 * The followings are the available columns in table 'cab_compra':
 * @property string $id_compra
 * @property string $id_proveedor
 * @property string $nro_documento
 * @property string $fecha_compra
 * @property string $fecha_registro
 * @property string $estado
 * @property string $user
 * @property integer $id_tipo_documento
 * @property double $sub_total
 * @property double $igv
 * @property double $total
 * @property string $estado_pago
 * @property string $obs
 * @property string $id_tipo_pago
 * @property double $descuento_total
 *
 * The followings are the available model relations:
 * @property TiposDocumentos $idTipoDocumento
 * @property TiposPago $idTipoPago
 * @property Proveedores $idProveedor
 */
class CabCompra extends CActiveRecord
{

	public $id_producto;
	public $date_first;
	public $date_last;
	public $date_first2;
	public $date_last2;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CabCompra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cab_compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_proveedor, fecha_compra, user, id_tipo_documento, total', 'required'),
			array('id_tipo_documento', 'numerical', 'integerOnly'=>true),
			array('igv, total, descuento_total', 'numerical'),
			array('id_proveedor, id_tipo_pago', 'length', 'max'=>10),
			array('nro_documento', 'length', 'max'=>30),
			array('user', 'length', 'max'=>50),
			array('obs,fecha_registro,fecha_eliminacion', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_compra, id_proveedor, nro_documento, fecha_compra, fecha_registro, estado, user, id_tipo_documento, igv, total, obs, id_tipo_pago, descuento_total, date_first, date_last,date_first2, date_last2', 'safe', 'on'=>'search'),
		);
	}	

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'idTipoDocumento' => array(self::BELONGS_TO, 'TiposDocumentos', 'id_tipo_documento'),
			'idTipoPago' => array(self::BELONGS_TO, 'FormasPago', 'id_tipo_pago'),
			'idProveedor' => array(self::BELONGS_TO, 'Proveedores', 'id_proveedor'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_compra' => 'Compra',
			'id_proveedor' => 'Proveedor',
			'nro_documento' => 'N. Ref',
			'fecha_compra' => 'Fecha',
			'fecha_registro' => 'Fecha Requerida',
			'user' => 'Creado por',			
			'id_tipo_documento' => 'Documento',
			//'sub_total' => 'SubTotal',
			'igv' => 'IVA',
			'total' => 'Total',
			'descuento_total' => 'Descuento',	
			'obs' => 'Obs',
			'id_tipo_pago' => 'Pago',					
		);
	}

	/*public static function getEstado($valor){
	return $valor==1?"Aprobado":"Cancelado";
	}
	
	public static function getListEstados()
	{
	return array('1'=>'Aprobado','0'=>'Cancelado');
	}*/
	
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
		$session=new CHttpSession;
		
		$criteria->compare('id_compra',$this->id_compra,true);
		$criteria->compare('id_proveedor',$this->id_proveedor,true);
		$criteria->compare('nro_documento',$this->nro_documento,true);
		$criteria->compare('fecha_compra',$this->fecha_compra,true);
		$criteria->compare('fecha_registro',$this->fecha_registro,true);
		//$criteria->compare('estado',$this->estado,true);
		$criteria->compare('user',$this->user,true);
		$criteria->compare('id_tipo_documento',$this->id_tipo_documento);
		//$criteria->compare('sub_total',$this->sub_total);
		$criteria->compare('igv',$this->igv);
		$criteria->compare('total',$this->total);
		$criteria->compare('obs',$this->obs,true);
		$criteria->compare('id_tipo_pago',$this->id_tipo_pago,true);
		$criteria->compare('descuento_total',$this->descuento_total);
			
		if((isset($this->date_first) && trim($this->date_first) != "") && (isset($this->date_last) && trim($this->date_last) != ""))
		$criteria->addBetweenCondition('fecha_compra', ''.$this->date_first.'', ''.$this->date_last.'');
		
		if((isset($this->date_first2) && trim($this->date_first2) != "") && (isset($this->date_last2) && trim($this->date_last2) != ""))
		$criteria->addBetweenCondition('fecha_registro', ''.$this->date_first2.'', ''.$this->date_last2.'');		
		
		$session->open();
		$session['cab-compra_records']=$criteria;
				
		return new CActiveDataProvider($this, array(
                   'pagination'=>array(	
                        'pageSize'=>5
                        ),	
                   'criteria'=>$criteria,
		));
	}
	
public function setListProductos($productos){
            $this->listProductos = $productos;
            $mdlProductos = array();
            foreach($this->listProductos as $producto){
                 $tmpProducto = new Detallecompra();
                 $tmpProducto->attributes = $producto;
                 $mdlProductos[] = $tmpProducto;
            }
            $this->listProductos = $mdlProductos;
        }	
}