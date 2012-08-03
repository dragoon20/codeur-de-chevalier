<?php 
class UploadPP extends CActiveRecord
{
    public $power_point;

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bb the static model class
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
		return 'upload';
	}
  
    public function rules()
    {
        return array(
            array('power_point', 'file', 'types'=>'ppt,pptx'),
        );
    }
	
	public function attributeLabels()
	{
		return array(
			'power_point' => 'Slide Power Point',
		);
	}
}
?>