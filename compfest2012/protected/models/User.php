<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $user_id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $nama
 * @property string $alamat
 * @property integer $handphone
 * @property string $tanggal_lahir
 * @property integer $user_type
 *
 * The followings are the available model relations:
 * @property UserType $userType
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email, nama, alamat, handphone, tanggal_lahir, user_type', 'required'),
			array('handphone, user_type', 'numerical', 'integerOnly'=>true),
			array('username, nama', 'length', 'max'=>30),
			array('password', 'length', 'max'=>100),
			array('email', 'length', 'max'=>40),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, username, password, email, nama, alamat, handphone, tanggal_lahir, user_type', 'safe', 'on'=>'search'),
		);
	}

	public function scopes()
    {
        return array(
            'notsafe'=>array(
            	'select' => 'user_id, username, password, user_type',
            ),
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
			'userType' => array(self::BELONGS_TO, 'UserType', 'user_type'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'User',
			'username' => 'Nama Pengguna',
			'password' => 'Sandi',
			'email' => 'Alamat Email',
			'nama' => 'Nama',
			'alamat' => 'Alamat',
			'handphone' => 'Handphone',
			'tanggal_lahir' => 'Tanggal Lahir',
			'user_type' => 'User Type',
			'verifyPassword' => 'Verifikasi Sandi'
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

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('nama',$this->nama,true);
		$criteria->compare('alamat',$this->alamat,true);
		$criteria->compare('handphone',$this->handphone);
		$criteria->compare('tanggal_lahir',$this->tanggal_lahir,true);
		$criteria->compare('user_type',$this->user_type);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}