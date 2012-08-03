<?php

/**
 * This is the model class for table "materi_pp".
 *
 * The followings are the available columns in table 'materi_pp':
 * @property integer $materi_pp_id
 * @property string $link_pp
 */
class MateriPp extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MateriPp the static model class
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
		return 'materi_pp';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('link_pp', 'required'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('materi_pp_id, link_pp', 'safe', 'on'=>'search'),
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
			'materi_pp_id' => 'Materi Pp',
			'link_pp' => 'Link Pp',
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

		$criteria->compare('materi_pp_id',$this->materi_pp_id);
		$criteria->compare('link_pp',$this->link_pp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}