<?php

/**
 * This is the model class for table "tipos_documentos".
 *
 * The followings are the available columns in table 'tipos_documentos':
 * @property integer $id_tipo_documento
 * @property string $desc
 *
 * The followings are the available model relations:
 * @property CabCompra[] $cabCompras
 */
class TiposDocumentos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TiposDocumentos the static model class
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
		return 'tipos_documentos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc', 'required'),
			array('desc', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_tipo_documento, desc', 'safe', 'on'=>'search'),
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
			'cabCompras' => array(self::HAS_MANY, 'CabCompra', 'id_tipo_documento'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_tipo_documento' => 'Id',
			'desc' => 'Descripcion',
		);
	}
	
	public static function getListDocumentos()
	{
		return CHtml::listData(TiposDocumentos::model()->findAll(),'id_tipo_documento','desc');
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

		$criteria->compare('id_tipo_documento',$this->id_tipo_documento);
		$criteria->compare('desc',$this->desc,true);
		
		$session->open();
		$session['tipos_documentos_records']=TiposDocumentos::model()->findAll($criteria);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

}