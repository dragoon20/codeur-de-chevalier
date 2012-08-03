<div class="form" style="margin-left:20px;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'materi-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="left" style="width:100px;"> <?php echo $form->label($model,'judul'); ?> </div>
		<div class="left"> <?php echo $form->textField($model,'judul',array('size'=>60,'maxlength'=>128)); ?> </div>
		<div class="left" style="margin-left:8px;"> <?php echo $form->error($model,'judul'); ?> </div>
	</div>
	<div class="clear"> </div>
	<div class="row">
		<div class="left" style="width:100px; "> <?php echo $form->label($model,'deskripsi'); ?> </div>
		<div class="left"> <?php echo $form->textArea($model,'deskripsi',array('rows'=>4, 'cols'=>70)); ?> </div>
		<div class="left" style="margin-left:8px;"><?php echo $form->error($model,'deskripsi'); ?> </div>
	</div>
	<div class="clear"> </div>
	
	<?php 
		/*
	<div class="row">
		<div class="left" style="width:100px; "> <?php echo $form->label($model,'urutan'); ?> </div>
		<div class="left"> <?php echo $form->textField($model,'urutan'); ?> </div>
		<div class="left" style="margin-left:8px;"><?php echo $form->error($model,'urutan'); ?> </div>
	</div>
	<div class="clear"> </div>
		*/
	?>
	
	<div class="row">
		<div class="left" style="width:100px; "> <?php echo $form->label($model2,'isi_kuliah'); ?> </div>
		<div class="left"> <?php echo $form->textArea($model2,'isi_kuliah',array('rows'=>8, 'cols'=>70)); ?> </div>
		<div class="left" style="margin-left:8px;"><?php echo $form->error($model2,'isi_kuliah'); ?> </div>
	</div>
	<div class="clear"> </div>
	<div class="left" style="width:100px;">&nbsp;</div>
	<div class="row submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buat' : 'Simpan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->