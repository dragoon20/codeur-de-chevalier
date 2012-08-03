<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Create',
);
?>

<h1>Tulis Berita</h1>

<?php echo $this->renderPartial('_form_kuliah', array('model'=>$model,'model2'=>$model2)); ?>