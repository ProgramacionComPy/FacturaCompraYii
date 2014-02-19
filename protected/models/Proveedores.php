<?php

/**
 * This is the model class for table "proveedores".
 *
 * The followings are the available columns in table 'proveedores':
 * @property string $id_proveedor
 * @property string $ciudades_id_ciudad
 * @property string $departamentos_id_departamento
 * @property string $paises_id_pais
 * @property string $nombre_proveedor
 * @property string $direccion_proveedor
 * @property string $telefono_proveedor
 * @property string $cell_proveedor
 * @property string $ruc_proveedor
 *
 * The followings are the available model relations:
 * @property Ofertas[] $ofertases
 * @property Paises $paisesIdPais
 * @property Departamentos $departamentosIdDepartamento
 * @property Ciudades $ciudadesIdCiudad
 */
class Proveedores extends CActiveRecord
{
	//Atributo agregado para consulta
	public $nprov;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Proveedores the static model class
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
		return 'proveedores';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ciudades_id_ciudad, departamentos_id_departamento, paises_id_pais', 'required'),
			array('ciudades_id_ciudad, departamentos_id_departamento, paises_id_pais', 'length', 'max'=>10),
			array('nombre_proveedor, direccion_proveedor, telefono_proveedor, cell_proveedor, ruc_proveedor', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('cta_cte','numerical'),
			array('email_proveedor','email'),
			array('email_proveedor','unique','attributeName'=>'email_proveedor','className'=>'Proveedores','allowEmpty'=>false),
			array('id_proveedor, ciudades_id_ciudad, departamentos_id_departamento, paises_id_pais, nombre_proveedor, direccion_proveedor, telefono_proveedor, cell_proveedor, ruc_proveedor', 'safe', 'on'=>'search'),
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
			'ofertas' => array(self::HAS_MANY, 'Ofertas', 'proveedores_id_proveedor'),
			'paises' => array(self::BELONGS_TO, 'Paises', 'paises_id_pais'),
			'departamentos' => array(self::BELONGS_TO, 'Departamentos', 'departamentos_id_departamento'),
			'ciudades' => array(self::BELONGS_TO, 'Ciudades', 'ciudades_id_ciudad'),
		);
	}
	
	public static function getListProveedores()
	{
		return CHtml::listData(Proveedores::model()->findAll(),'id_proveedor','nombre_proveedor');
	}
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_proveedor' => 'Id',
			'ciudades_id_ciudad' => 'Ciudad',
			'departamentos_id_departamento' => 'Departamento',
			'paises_id_pais' => 'Pais',
			'nombre_proveedor' => 'Nombre',
			'direccion_proveedor' => 'Direccion',
			'telefono_proveedor' => 'Telefono',
			'cell_proveedor' => 'Celular',
			'ruc_proveedor' => 'RUC/CI',
			'email_proveedor'=> 'Email',
			'cta_cte'=>'Deuda',
			'nprov'=>'nprov',
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

		$criteria->compare('id_proveedor',$this->id_proveedor,true);
		//$criteria->compare('ciudades_id_ciudad',$this->ciudades_id_ciudad,true);
		//$criteria->compare('departamentos_id_departamento',$this->departamentos_id_departamento,true);
		//$criteria->compare('paises_id_pais',$this->paises_id_pais,true);
		$criteria->compare('nombre_proveedor',$this->nombre_proveedor,true);
		$criteria->compare('direccion_proveedor',$this->direccion_proveedor,true);
		$criteria->compare('telefono_proveedor',$this->telefono_proveedor,true);
		$criteria->compare('cell_proveedor',$this->cell_proveedor,true);
		$criteria->compare('ruc_proveedor',$this->ruc_proveedor,true);
		
		$criteria->with = array( 'ciudades','departamentos','paises' );
		$criteria->compare('paises.desc_pais',$this->paises_id_pais,true);
		$criteria->compare('departamentos.desc_departamento',$this->departamentos_id_departamento,true);
		$criteria->compare('ciudades.desc_ciudad',$this->ciudades_id_ciudad,true);
		
		
		$session->open();
		$session['proveedores_records']=Proveedores::model()->findAll($criteria);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			  'sort'=>array(
				'attributes'=>array(
				
            'paises_id_pais'=>array(
                'asc'=>'paises.desc_pais',
                'desc'=>'paises.desc_pais DESC',
            ),
			    'departamentos_id_departamento'=>array(
                'asc'=>'departamentos.desc_departamento',
                'desc'=>'departamentos.desc_departamento DESC',
            ),
			    'ciudades_id_ciudad'=>array(
                'asc'=>'ciudades.desc_ciudad',
                'desc'=>'ciudades.desc_ciudad DESC',
            ),
            '*',
		),
		),
		));
	}
	

}