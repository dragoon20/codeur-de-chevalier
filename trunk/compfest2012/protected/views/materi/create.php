<?php
$this->breadcrumbs=array(
	'Materi'=>array('index'),
	'Buat',
);
?>

<h1>Buat Materi</h1>

<div class="link_blue left">
<?php
	echo CHtml::link("Tulis Materi",Yii::app()->baseUrl."/materi/create_kuliah"); 
?>
</div>

<div class="link_blue left">
<?php
	echo CHtml::link("Upload Slide Materi",Yii::app()->baseUrl."/materi/create_pp"); 
?>
</div>