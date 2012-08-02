<?php

/**
 * This is the model class for table "materi".
 *
 * The followings are the available columns in table 'materi':
 * @property integer $materi_id
 * @property integer $materi_type
 * @property integer $type_id
 * @property integer $template_id
 * @property integer $urutan
 *
 * The followings are the available model relations:
 * @property Template $template
 * @property MateriJudul $materiJudul
 */
class Materi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Materi the static model class
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
		return 'materi';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('materi_type, type_id, template_id, urutan, judul, deskripsi', 'required'),
			array('materi_type, type_id, template_id, urutan', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('materi_id, materi_type, type_id, template_id, urutan, judul, deskripsi', 'safe', 'on'=>'search'),
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
			'template' => array(self::BELONGS_TO, 'Template', 'template_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'materi_id' => 'Materi',
			'materi_type' => 'Materi Type',
			'type_id' => 'Type',
			'template_id' => 'Template',
			'urutan' => 'Urutan',
			'judul' => 'Judul',
			'deskripsi' => 'Deskripsi',
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

		$criteria->compare('materi_id',$this->materi_id);
		$criteria->compare('materi_type',$this->materi_type);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('template_id',$this->template_id);
		$criteria->compare('urutan',$this->urutan);
		$criteria->compare('judul',$this->judul);
		$criteria->compare('deskripsi',$this->deskripsi);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('update_time',$this->update_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}