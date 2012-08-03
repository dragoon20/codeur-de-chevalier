<?php
$this->breadcrumbs=array(
	'Materi',
);
?>

<?php 
	$temp = '_view';
	$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'ajaxUpdate' => false,
	'itemView'=>$temp,
	'template'=>"{items}\n{pager}",
)); ?>

