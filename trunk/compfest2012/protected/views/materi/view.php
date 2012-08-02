<?php
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	$model->title,
);?>

<?php $this->renderPartial('_view', array(
	'data'=>$model,
)); ?>

<div id="comments">
	<?php if($model->commentCount>=1): ?>
		<h3>
			<?php echo $model->commentCount>1 ? $model->commentCount . ' comments' : 'One comment'; ?>
		</h3>
		
		<?php
		$i=1;
		$this->widget('zii.widgets.CListView', array(
			'dataProvider'=>new CActiveDataProvider('Comment', array(
					'criteria'=>array(
						'condition'=>'post_id='.$model->id,
						'order'=>'create_time desc',
					),
					'pagination'=>array(
						'pageSize'=>5,
					),
					)),
			'ajaxUpdate' => false,
			'viewData'=>array(
						'post'=>$model,
					),
			'itemView'=>'_comments',
			'template'=>"{items}\n{pager}",
		));
		?>
	<?php endif; ?>

	<h3>Tulis Komentar</h3>

	<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
		</div>
	<?php else: ?>
		<?php $this->renderPartial('/comment/_form',array(
			'model'=>$comment,
		)); ?>
	<?php endif; ?>

</div><!-- comments -->

