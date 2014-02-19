<?php

/**
 * This is the model class for table "det_compra2".
 *
 * The followings are the available columns in table 'det_compra2':
 * @property string $id_detalle
 * @property string $id_compra
 * @property string $id_producto
 * @property double $precio_unitario
 * @property integer $cantidad_producto
 * @property double $descuento_producto
 * @property string $subtotal_iva
 * @property double $subtotal_producto
 */
class DetalleCompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DetCompra2 the static model class
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
		return 'det_compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_producto, precio_unitario, cantidad_producto, subtotal_producto', 'required'),
			array('cantidad_producto', 'numerical', 'integerOnly'=>true),
			array('precio_unitario, descuento_producto, subtotal_producto', 'numerical'),
			array('id_compra, id_producto', 'length', 'max'=>10),
			array('subtotal_iva', 'length', 'max'=>9),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_detalle, id_compra, id_producto, precio_unitario, cantidad_producto, descuento_producto, subtotal_iva, subtotal_producto', 'safe', 'on'=>'search'),
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
		'compra' => array(self::BELONGS_TO, 'CabCompra', 'id_compra'),
		'producto' => array(self::BELONGS_TO, 'Productos', 'id_producto'),	
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_detalle' => 'Id',
			'id_compra' => 'Compra',
			'id_producto' => 'DESCRIPCION',
			'precio_unitario' => 'PRECIO UNITARIO',
			'cantidad_producto' => 'CANTIDAD',
			'descuento_producto' => 'DESC %',
			'subtotal_iva' => 'IVA %',
			'subtotal_producto' => 'TOTAL',
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
		$criteria->with=array('compra','producto');
	    if (isset($_GET['DetalleCompra'])) 
		{
		$model=new DetalleCompra('search');
		$model->attributes = $_GET['DetalleCompra'];
		$criteria->condition='t.id_compra='.$model->id_compra;
		} 
		else 
		{
		$criteria->condition='t.id_compra=0';
		}
		
		$criteria->compare('id_detalle',$this->id_detalle,true);
		$criteria->compare('compra.id_compra',$this->id_compra);
		$criteria->compare('id_producto',$this->id_producto);
		$criteria->compare('precio_unitario',$this->precio_unitario);
		$criteria->compare('cantidad_producto',$this->cantidad_producto);
		$criteria->compare('descuento_producto',$this->descuento_producto);
		$criteria->compare('subtotal_iva',$this->subtotal_iva);
		$criteria->compare('subtotal_producto',$this->subtotal_producto);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			              'pagination'=>array(	
                        'pageSize'=>5
                        ),	
		));				
	} 
}  