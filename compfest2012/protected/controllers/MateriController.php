<?php

class MateriController extends Controller
{

	private $_model;

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Materi', array(
					'pagination'=>array(
						'pageSize'=>5,
					),));
					
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionView()
	{
		$post=$this->loadModel();
		$comment=$this->newComment($post);
		
		$this->render('view',array(
			'model'=>$post,
			'comment'=>$comment,
		));
	}
	
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
			{
				$this->_model=Materi::model()->findByPk($_GET['id'], '');
			}
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
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