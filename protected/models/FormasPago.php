<?php

/**
 * This is the model class for table "formas_pago".
 *
 * The followings are the available columns in table 'formas_pago':
 * @property string $id_forma
 * @property string $desc_forma
 */
class FormasPago extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FormasPago the static model class
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
		return 'formas_pago';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('desc_forma', 'required'),
			array('desc_forma', 'length', 'max'=>45),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_forma, desc_forma', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_forma' => 'Id',
			'desc_forma' => 'Descripción',
		);
	}

	public static function getListFormasPagos($valor=false)
	{
	if($valor==false) 
	return CHtml::listData(FormasPago::model()->findAll(),'id_forma','desc_forma'); 
	else 
	return CHtml::listData(FormasPago::model()->findAll('id_forma<3'),'id_forma','desc_forma');
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
		
		$criteria->compare('id_forma',$this->id_forma,true);
		$criteria->compare('desc_forma',$this->desc_forma,true);

        $session->open();
		$session['formas_pago_records']=FormasPago::model()->findAll($criteria);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


}  