<?php

/**
 * This is the model class for table "text_box".
 *
 * The followings are the available columns in table 'text_box':
 * @property integer $id_textbox
 * @property integer $posisi_x
 * @property integer $posisi_y
 *
 * The followings are the available model relations:
 * @property Template[] $templates
 */
class Text extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Text the static model class
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
		return 'text_box';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('posisi_x, posisi_y', 'required'),
			array('posisi_x, posisi_y', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_textbox, posisi_x, posisi_y', 'safe', 'on'=>'search'),
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
			'templates' => array(self::HAS_MANY, 'Template', 'id_text_box'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_textbox' => 'Id Textbox',
			'posisi_x' => 'Posisi X',
			'posisi_y' => 'Posisi Y',
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

		$criteria->compare('id_textbox',$this->id_textbox);
		$criteria->compare('posisi_x',$this->posisi_x);
		$criteria->compare('posisi_y',$this->posisi_y);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}