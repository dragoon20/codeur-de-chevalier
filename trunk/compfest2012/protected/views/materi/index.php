<?php 
	if (Yii::app()->user->isGuest)
	{
		$temp = '_view';
	}
	else
	{
		$temp = '_view';
	}
	$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'ajaxUpdate' => false,
	'itemView'=>$temp,
	'template'=>"{items}\n{pager}",
)); ?>

