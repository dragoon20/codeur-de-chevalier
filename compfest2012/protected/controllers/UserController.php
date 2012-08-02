<?php

class UserController extends Controller
{
	public function actionIndex()
	{
		$this->render('index');
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (Yii::app()->user->isGuest) {
			$model=new UserLogin;
			// collect user input data
			if(isset($_POST['UserLogin']))
			{
				$model->attributes=$_POST['UserLogin'];
				// validate user input and redirect to previous page if valid
				if($model->validate()) {
					$this->lastViset();
					if (Yii::app()->user->returnUrl=='/index.php')
						$this->redirect('/index.php/post');
					else
						$this->redirect(Yii::app()->request->baseUrl.'/index.php/post');
				}
			}
			// display the login form
			$this->render('login', array('model' => $model));
		} else
			$this->redirect(Yii::app()->request->baseUrl.'/index.php/post');
	}
	
	public function actionRegister()
	{
		if (Yii::app()->user->isGuest) {
			$model = new RegistrationForm;
            $profile = new Profiles;
            $profile->regMode = true;
            
			// ajax validator
			if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
			{
				echo UActiveForm::validate(array($model,$profile));
				Yii::app()->end();
			}
			
		    if (Yii::app()->user->id) {
		    	$this->redirect("../users/profile");
		    } else {
		    	if(isset($_POST['RegistrationForm'])) {
					$model->attributes=$_POST['RegistrationForm'];
					$profile->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
					if($model->validate()&&$profile->validate())
					{
						$soucePassword = $model->password;
						$model->activkey=md5(microtime().$model->password);
						$model->password=md5($model->password);
						$model->verifyPassword=md5($model->verifyPassword);
						$model->superuser=0;
						
						if ($model->save()) {
							$profile->user_id=$model->id;
							$profile->save();
							/*if (Yii::app()->controller->module->sendActivationMail) {
								$activation_url = $this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email));
								UserModule::sendMail($model->email,UserModule::t("You registered from {site_name}",array('{site_name}'=>Yii::app()->name)),UserModule::t("Please activate you account go to {activation_url}",array('{activation_url}'=>$activation_url)));
							}*/
							
							Yii::app()->user->setFlash('registration',"Thank you for your registration. Welcome to KMB Dhammanano ITB. You can login now.");
								$this->refresh();
						}
					} else $profile->validate();
				}
			    $this->render('/user/registration',array('model'=>$model,'profile'=>$profile));
		    }
		} else
			$this->redirect(Yii::app()->request->baseUrl.'/index.php/post');
	}
	
	public function actionForgotPass()
	{
		if (Yii::app()->user->isGuest) {
			$model = new ForgotForm;
		} else
			$this->redirect(Yii::app()->request->baseUrl.'/index.php/post');
	}
	
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}