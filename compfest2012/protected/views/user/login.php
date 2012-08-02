<?php
$this->breadcrumbs=array(
	"Login",
);
?>

<div style="font-size:20px;padding-bottom:10px;">
	<?php echo "MASUK"; ?>
</div>

<?php if(Yii::app()->user->hasFlash('loginMessage')): ?>

<div class="success">
	<?php echo Yii::app()->user->getFlash('loginMessage'); ?>
</div>

<?php endif; ?>

<div class="form">
<?php echo CHtml::beginForm(); ?>
	
	<?php echo CHtml::errorSummary($model); ?>
	<div class="row">
		<div style="" class="left"> <?php echo CHtml::activeLabel($model,'username'); ?> </div>
		<div class="left"><?php echo CHtml::activeTextField($model,'username') ?> </div>
	</div>
	<div style="clear:both"> </div>
	<div class="row">
		<div class="left"> <?php echo CHtml::activeLabel($model,'password'); ?> </div>
		<div class="left"> <?php echo CHtml::activePasswordField($model,'password') ?></div>
	</div>
	<div style="clear:both"> </div>	
	<div class="row rememberMe">
		<div class="left"><?php echo CHtml::activeCheckBox($model,'rememberMe'); ?></div>
		<div class="left"><?php echo CHtml::activeLabel($model,'rememberMe'); ?></div>
	</div>
	<div style="clear:both"> </div>
	<div class="row submit">
		<?php echo CHtml::submitButton('Masuk'); ?>
	</div>
	
<?php echo CHtml::endForm(); ?>
</div><!-- form -->