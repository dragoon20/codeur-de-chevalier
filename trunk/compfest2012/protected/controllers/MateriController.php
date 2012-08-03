<?php

class MateriController extends Controller
{

	private $_model;

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Materi', array(
					'criteria'=>array(
						'order'=>'update_time DESC'
					),	
					'pagination'=>array(
						'pageSize'=>5,
					),));
					
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
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
	
	public function actionCreate()
	{
		$this->render('create');
	}
	
	public function actionCreate_kuliah()
	{
		$model = new Materi;
		$model2 = new MateriKuliah;
		if((isset($_POST['Materi']))&&(isset($_POST['MateriKuliah'])))
		{
			$model->attributes=$_POST['Materi'];
			$model->materi_type=1;
			$model->urutan=1; //$_POST['urutan'];
			$model->template_id=1;
			$model2->attributes=$_POST['MateriKuliah'];
			if ($model2->save())
			{
				$model->type_id=$model2->materi_kuliah_id;
				if ($model->save())
					$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		
		$this->render('create_kuliah',array(
			'model'=>$model,
			'model2'=>$model2,
		));
	}
	
	public function actionCreate_pp()
	{
		$model = new Materi;
		$model2 = new UploadPP;
		
		if((isset($_POST['judul']))&&(isset($_POST['deskripsi']))&&(isset($_POST['UploadPP'])))
		{
			$model->judul=$_POST['judul'];
			$model->deskripsi=$_POST['deskripsi'];
			$model->urutan=1; //$_POST['urutan'];
			$model2->attributes=$_POST['UploadPP'];
			$model2->power_point=CUploadedFile::getInstance($model2,'power_point');
			$model2->power_point->saveAs(Yii::app()->basePath.'/../images/Slides/'.$model2->power_point->name);
			
			$model3 = new MateriPp;
			$model3->link_pp = Yii::app()->baseUrl.'/images/Slides/'.$model2->power_point->name;
			
			$model->materi_type=2;
			$model->template_id=1;
			
			if($model3->save())
			{
				$model->type_id=$model3->materi_pp_id;
				if ($model->save())
					$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		
		
		$this->render('create_pp',array(
			'model'=>$model,
			'model2'=>$model2,
		));
	}
	
	public function actionChange_data_kuliah()
	{
		$model = $this->loadModel();
		$model2 = MateriKuliah::model()->findByPk($model->type_id,'');
	
		if((isset($_POST['Materi']))&&(isset($_POST['MateriKuliah'])))
		{
			$model->attributes=$_POST['Materi'];
			$model->urutan=1; //$_POST['urutan'];
			$model->materi_type=1;
			$model2->attributes=$_POST['MateriKuliah'];
			if(($model->save())&&($model2->save()))
				$this->redirect(Yii::app()->user->returnUrl);
		}
	
		$this->render('update_kuliah',array(
			'model'=>$model,
			'model2'=>$model2,
		));
	}
	
	public function actionChange_data_pp()
	{
		$model = $this->loadModel();
		$model2 = new UploadPP;
	
		if((isset($_POST['judul']))&&(isset($_POST['deskripsi']))&&(isset($_POST['UploadPP'])))
		{
			$model->judul=$_POST['judul'];
			$model->deskripsi=$_POST['deskripsi'];
			$model->urutan=1; //$_POST['urutan'];
			$model2->attributes=$_POST['UploadPP'];
			$model2->power_point=CUploadedFile::getInstance($model2,'power_point');
			$model2->power_point->saveAs(Yii::app()->basePath.'/../images/Slides/'.$model2->power_point->name);
				
			$model3 = new MateriPp;
			$model3->link_pp = Yii::app()->baseUrl.'/images/Slides/'.$model2->power_point->name;
				
			$model->materi_type=2;
			$model->template_id=1;
				
			if($model3->save())
			{
				$model->type_id=$model3->materi_pp_id;
				if ($model->save())
					$this->redirect(Yii::app()->user->returnUrl);
			}
		}
	
	
		$this->render('update_pp',array(
				'model'=>$model,
				'model2'=>$model2,
		));
	}
	
	public function actionChange_template()
	{
		$model = $this->loadModel();
		$template = Template::model()->findAll();
		
		if (ISSET($_POST['template_id']))
		{
			$model->template_id=$_POST['template_id'];
			if ($model->save())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		
		$this->render('change_template',array(
			'model'=>$model,
			'template'=>$template,
		));
	}
	
	public function actionManage()
	{
		$dataProvider=new CActiveDataProvider('Materi', array(
					'criteria'=>array(
						'condition'=>'user_id='.Yii::app()->user->id,
						'order'=>'update_time DESC'
					),	
					'pagination'=>array(
						'pageSize'=>5,
					),));
					
		$this->render('manage',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionView()
	{
		$model = $this->loadModel();
		if ($model->materi_type==1)
			$isi = MateriKuliah::model()->findByPk($model->type_id,'');
		else if ($model->materi_type==2)
			$isi = MateriPp::model()->findByPk($model->type_id,'');
		$template = Template::model()->findByPk($model->template_id, '');
		$this->layout = '//layouts/viewmateri';

		$this->render('view',array(
			'model'=>$model,
			'template'=>$template,
			'isi'=>$isi,
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