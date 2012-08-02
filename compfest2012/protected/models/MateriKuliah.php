<?php

/**
 * This is the model class for table "materi_kuliah".
 *
 * The followings are the available columns in table 'materi_kuliah':
 * @property integer $materi_kuliah_id
 * @property string $isi_kuliah
 */
class MateriKuliah extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MateriKuliah the static model class
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
		return 'materi_kuliah';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('isi_kuliah', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('materi_kuliah_id, isi_kuliah', 'safe', 'on'=>'search'),
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
			'materi_kuliah_id' => 'Materi Kuliah',
			'isi_kuliah' => 'Isi Kuliah',
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

		$criteria->compare('materi_kuliah_id',$this->materi_kuliah_id);
		$criteria->compare('isi_kuliah',$this->isi_kuliah,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}