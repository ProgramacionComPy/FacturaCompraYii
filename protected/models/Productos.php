<?php

/**
 * This is the model class for table "Productos".
 *
 * The followings are the available columns in table 'Productos':
 * @property string $id_producto
 * @property integer $id_categoria
 * @property integer $id_marca
 * @property string $descripcion
 * @property string $unidad_medida
 * @property string $estado
 *
 * The followings are the available model relations:
 * @property DetCompra[] $detCompras
 * @property ProductoProveedor[] $productoProveedors
 */
class Productos extends CActiveRecord
{
	public static $estado=array('1'=>'Alta','2'=>'Baja');
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Productos the static model class
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
		return 'Productos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_categoria, id_marca, descripcion, unidad_medida, id_igv, precio_compra', 'required'),
			array('id_categoria, id_marca, id_igv', 'numerical', 'integerOnly'=>true),
			array('descuento, precio_compra', 'numerical'),
			array('descripcion', 'length', 'max'=>150),
			array('unidad_medida', 'length', 'max'=>80),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_producto, id_categoria, id_marca, descripcion, unidad_medida, id_igv, descuento, precio_compra', 'safe', 'on'=>'search'),
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
			'detCompras' => array(self::HAS_MANY, 'DetCompra', 'id_producto'),
		);
	}
	
	/*public static function getEstado($key=null)
	{
		if($key!==null)
			return self::$estado[$key];
		return self::$estado;	
	}*/
	
	public static function getListProductos()
	{
		return CHtml::listData(Productos::model()->findAll(),'id_producto','descripcion');
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_producto' => 'Id',
			'id_categoria' => 'Categoría',
			'id_marca' => 'Marca',
			'descripcion' => 'Descripción',
			'unidad_medida' => 'Unidad Medida',
			'id_igv' => '% IVA',
			'precio_compra' => 'Precio Compra',
			'descuento' => '% Dcto',
		);
	}

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
		
		$criteria->compare('id_producto',$this->id_producto,true);
		$criteria->compare('id_categoria',$this->id_categoria);
		$criteria->compare('id_marca',$this->id_marca);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('unidad_medida',$this->unidad_medida,true);
		//$criteria->compare('estado',$this->estado,true);
		$criteria->compare('id_igv',$this->id_igv);
		$criteria->compare('precio_compra',$this->precio_compra);
		$criteria->compare('descuento',$this->descuento);

        $session->open();
		$session['productos_records']=Productos::model()->findAll($criteria);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}  