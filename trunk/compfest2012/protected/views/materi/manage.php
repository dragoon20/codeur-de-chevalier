<?php 
	$temp = '_view_manage';

	$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'ajaxUpdate' => false,
	'itemView'=>$temp,
	'template'=>"{items}\n{pager}",
)); ?>
