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

<div class="left" style="margin-left:30px;">
	<img style="width:400px;" src="<?php echo Yii::app()->request->baseUrl?>/images/kidsart.gif">
</div>

<div class="form left" style="margin-left:70px; width:350px;">
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
	<div class="row submit" style="float:right; margin-right:80px;">
		<?php echo CHtml::submitButton('Masuk'); ?>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div>
<!-- form -->
