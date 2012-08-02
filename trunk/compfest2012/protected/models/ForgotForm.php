<?php
class ForgotForm extends User {
	public $email;
	
	public function rules() {
		$rules = array(
			array('email', 'required'),
			array('email', 'length', 'max'=>200, 'min' => 4,'message' => "Incorrect email (length between 4 and 100 characters)."),
			array('email', 'email'),
		);
		
		return $rules;
	}
	
	public function attributeLabels()
	{
		return array(
			'email'=>"Alamat Email",
		);
	}
	
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())  // we only want to authenticate when no input errors
		{
			$identity=new UserIdentity($this->username,$this->password);
			$identity->authenticate();
			switch($identity->errorCode)
			{
				case UserIdentity::ERROR_NONE:
					$duration=$this->rememberMe ? 2592000 : 0;
					Yii::app()->user->login($identity,$duration);
					break;
				case UserIdentity::ERROR_USERNAME_INVALID:
					$this->addError("username","Username is incorrect.");
					break;
				case UserIdentity::ERROR_PASSWORD_INVALID:
					$this->addError("password","Password is incorrect.");
					break;
			}
		}
	}
}