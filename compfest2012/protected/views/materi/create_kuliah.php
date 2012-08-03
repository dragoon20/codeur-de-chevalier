<?php
$this->breadcrumbs=array(
	'Materi'=>array('index'),
	'Create Kuliah',
);
?>

<h1>Tulis Materi</h1>

<?php echo $this->renderPartial('_form_kuliah', array('model'=>$model,'model2'=>$model2)); ?>