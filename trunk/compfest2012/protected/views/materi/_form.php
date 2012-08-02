<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'materi-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->label($model,'judul'); ?>
		<?php echo $form->textField($model,'judul',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'judul'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'deskripsi'); ?>
		<?php echo $form->textArea($model,'deskripsi',array('rows'=>18, 'cols'=>70)); ?>
		<?php echo $form->error($model,'deskripsi'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->label($model,'urutan'); ?>
		<?php echo $form->textField($model,'urutan'); ?>
		<?php echo $form->error($model,'urutan'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buat' : 'Simpan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->