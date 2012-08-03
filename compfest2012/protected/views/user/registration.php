<?php 
$this->breadcrumbs=array(
	"Daftar",
);
?>

<div class="link_red">  MENDAFTARKAN DIRI MENJADI MURID DUNIA ANAK CERDAS </div>
<br><br>

<?php if(Yii::app()->user->hasFlash('registration')): ?>
<div class="success">
<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>
<?php else: ?>
<div class="form" style="margin-left:20px;">
<?php $form=$this->beginWidget('UActiveForm', array(
	'id'=>'registration-form',
	'enableAjaxValidation'=>true,
	'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
)); ?>
	
	<?php echo $form->errorSummary(array($model,$profile));?>
	
	<div class="row">
		<div style="width:120px;" class="left"> <?php echo $form->label($model,'username'); ?> </div>
		<div class="left"> <?php echo $form->textField($model,'username'); ?> </div>
		<div class="left" style="margin-left:5px;margin-top:3px;"> <?php echo $form->error($model,'username'); ?> </div>
	</div>
	<div class="clear"> </div>
	<div class="row">
		<div style="width:120px;" class="left"> <?php echo $form->label($model,'password'); ?> </div>
		<div class="left"> <?php echo $form->passwordField($model,'password'); ?> </div>
		<div class="left" style="margin-left:5px;margin-top:3px;"> <?php echo $form->error($model,'password'); ?> </div>
	</div>
	<div class="clear"> </div>
	<div class="row">
		<div style="width:120px;" class="left"> <?php echo $form->label($model,'verifyPassword'); ?> </div>
		<div class="left"> <?php echo $form->passwordField($model,'verifyPassword'); ?> </div>
		<div class="left" style="margin-left:5px;margin-top:3px;"> <?php echo $form->error($model,'verifyPassword'); ?> </div>
	</div>
	<div class="clear"> </div>
<?php 
		$profileFields=$profile->getFields();
		if ($profileFields) {
			foreach($profileFields as $field) {
			?>
	<div class="row">
		<div style="width:120px;" class="left"> <?php echo $form->label($profile,$field->varname); ?> </div>
		<div class="left">
		<?php 
		if ($widgetEdit = $field->widgetEdit($profile)) {
			echo $widgetEdit;
		} elseif ($field->field_type=="DATE"){
			$tempdate=$field->varname;
			$this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'language'=>'en',
			'model'=>$profile,
			'name'=>'Profiles['.$field->varname.']',
			'id'=>'Profiles_'.$field->varname,
			'value'=>$profile->$tempdate,
			// additional javascript options for the date picker plugin
			'options'=>array(
				'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
				'defaultDate'=>'$( ".selector" ).datepicker( "option", "defaultDate", -18y );',
			),
		));
		} elseif ($field->field_type=="TEXT") {
			echo $form->textArea($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			if ($field->varname=="hp")
			{
				echo $form->textField($profile,$field->varname,array('value'=>'+62','size'=>50,'maxlength'=>(($field->field_size)?$field->field_size:255)));
			}
			else
			{
				echo $form->textField($profile,$field->varname,array('size'=>50,'maxlength'=>(($field->field_size)?$field->field_size:255)));
			}
		}
		?>
		</div>
		  
		<div class="left" style="margin-left:5px;margin-top:3px;"> <?php echo $form->error($profile,$field->varname); ?> </div>
	</div>	
		<div class="clear"> </div>
			<?php
			}
		}
?>	
	<br>
	<div class="row submit left">
		<?php echo CHtml::submitButton("DAFTAR"); ?>
	</div>
	<br><br>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php endif; ?>