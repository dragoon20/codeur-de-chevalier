<?php

/**
 * This is the model class for table "template".
 *
 * The followings are the available columns in table 'template':
 * @property integer $id_template
 * @property integer $id_judul
 * @property integer $id_text_box
 * @property integer $id_icon
 * @property string $background_link
 *
 * The followings are the available model relations:
 * @property Materi[] $materis
 */
class Template extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Template the static model class
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
		return 'template';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_judul, id_text_box, id_icon, background_link, preview_link', 'required'),
			array('id_judul, id_text_box, id_icon', 'numerical', 'integerOnly'=>true),
			array('background_link', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id_template, id_judul, id_text_box, id_icon, background_link', 'safe', 'on'=>'search'),
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
			'materis' => array(self::HAS_MANY, 'Materi', 'template_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_template' => 'Id Template',
			'id_judul' => 'Id Judul',
			'id_text_box' => 'Id Text Box',
			'id_icon' => 'Id Icon',
			'background_link' => 'Background Link',
			'preview_link' => 'Preview Link',
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

		$criteria->compare('id_template',$this->id_template);
		$criteria->compare('id_judul',$this->id_judul);
		$criteria->compare('id_text_box',$this->id_text_box);
		$criteria->compare('id_icon',$this->id_icon);
		$criteria->compare('background_link',$this->background_link,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}