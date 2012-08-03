<?php
$this->breadcrumbs=array(
	'Materi'=>array('index'),
	'Create Power Point',
);
?>

<div style="margin-left:20px; font-size:25px;padding-bottom:25px; ">Upload Materi</div>

<div class="form" style="margin-left:20px;">

<?php echo CHtml::form('','post',array('enctype'=>'multipart/form-data')); ?>

	<?php echo CHtml::errorSummary($model); ?>
	
	<div class="row">
		<div class="left" style="width:120px;"> <?php echo CHtml::activeLabel($model,'judul'); ?> </div>
		<div class="left"> <?php echo CHtml::textField('judul','',array('size'=>60,'maxlength'=>128));?> </div>
		<div class="left" style="margin-left:8px;"> <?php echo CHtml::error($model,'judul'); ?> </div>
	</div>
	<div class="clear"> </div>
	<div class="row">
		<div class="left" style="width:120px; "> <?php echo CHtml::activeLabel($model,'deskripsi'); ?> </div>
		<div class="left"> <?php echo CHtml::textArea('deskripsi','',array('rows'=>4, 'cols'=>70)); ?> </div>
		<div class="left" style="margin-left:8px;"><?php echo CHtml::error($model,'deskripsi'); ?> </div>
	</div>
	<div class="clear"> </div>
	
	<div class="row">
		<div class="left" style="width:120px; "> <?php echo CHtml::activeLabel($model,'urutan'); ?> </div>
		<div class="left"> <?php echo CHtml::textField('urutan'); ?> </div>
		<div class="left" style="margin-left:8px;"><?php echo CHtml::error($model,'urutan'); ?> </div>
	</div>
	<div class="clear"> </div>
	
	<div class="row">
		<div class="left" style="width:120px; "><?php echo CHtml::activeLabel($model2,'power_point'); ?></div>
		<div class="left"><?php echo CHtml::activeFileField($model2, 'power_point'); ?></div>
	</div>
	
	<div class="clear"> </div>
	<div class="left" style="width:100px;">&nbsp;</div>
	<div class="row submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buat' : 'Simpan'); ?>
	</div>

<?php echo CHtml::endForm(); ?>

</div><!-- form -->