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
	
	public function actionCreate_kuliah()
	{
		$model = new Materi;
		$model2 = new MateriKuliah;
		if((isset($_POST['Materi']))&&(isset($_POST['MateriKuliah'])))
		{
			$model->attributes=$_POST['Materi'];
			$model->materi_type=1;
			$model->type_id=1;
			$model->template_id=1;
			$model2->attributes=$_POST['MateriKuliah'];
			if(($model->save())&&($model2->save()))
				$this->redirect(array('materi/index'));
		}
		
		$this->render('create_kuliah',array(
			'model'=>$model,
			'model2'=>$model2,
		));
	}
	
	public function actionChange_template()
	{
		//$model = $this->loadModel();
		$model = new Materi;
		$template = Template::model()->findAll();
		
		$this->render('changetemplate',array(
			'model'=>$model,
			'template'=>$template,
		));
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