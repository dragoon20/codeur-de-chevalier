<?php
$this->breadcrumbs=array(
	'Materi'=>array('index'),
	'Buat',
);
?>
<div style="margin-left:20px;">
	<h2 style="color:#5f5f5f;">Membuat Materi Pelajaran</h2>
	<br>
	<div class="link_blue left">
	<?php
		echo CHtml::link("Tulis Materi",Yii::app()->baseUrl."/materi/create_kuliah"); 
	?>
	</div>
	<div class="link_blue left" style="margin-left:15px;">
	<?php
		echo CHtml::link("Upload Slide Materi",Yii::app()->baseUrl."/materi/create_pp"); 
	?>
	</div>
</div>