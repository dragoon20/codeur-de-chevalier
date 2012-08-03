<?php
$this->breadcrumbs=array(
	"Masuk",
);
?>

<!--
<div style="font-size:20px;padding-bottom:10px;">
	<?php echo "MASUK"; ?>
</div> -->

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<div class="form left" style="width:350px; background-color:orange;">
<?php echo CHtml::beginForm(); ?>
	
	<?php echo CHtml::errorSummary($model); ?>
	<div class="row">
		<div style="width:120px;" class="left"> <?php echo CHtml::activeLabel($model,'username'); ?> </div>
		<div class="left"><?php echo CHtml::activeTextField($model,'username') ?> </div>
	</div>
	<div style="clear:both"> </div>
	<div class="row">
		<div style="width:120px;" class="left"> <?php echo CHtml::activeLabel($model,'password'); ?> </div>
		<div class="left"> <?php echo CHtml::activePasswordField($model,'password') ?></div>
	</div>
	<div style="clear:both"> </div>	
	<div class="row rememberMe">
		<?php echo CHtml::activeCheckBox($model,'rememberMe'); ?> &nbsp;
		<?php echo CHtml::activeLabel($model,'rememberMe'); ?>
	</div>
	<div class="row submit">
		<?php echo CHtml::submitButton('Masuk'); ?>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div>
<!-- form -->
<div class="left" style="width:350px; height:300px; background-color:yellow;">
	<!-- <img style="float:right;" src="<?php echo Yii::app()->request->baseUrl?>/images/kidsart.gif"> -->
</div>