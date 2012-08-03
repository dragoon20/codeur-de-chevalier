<div class="materi">
	<div class="title">
		<h1>
		<?php 
			if (!Yii::app()->user->isGuest)
				echo CHtml::link(CHtml::encode($data->judul), "view/".$data->materi_id);
			else
				echo CHtml::encode($data->judul);
			$profile=Profiles::model()->findByAttributes(array('user_id'=>$data->user_id));
		?>
		</h1>
	</div>
	<div class="author">
		oleh <?php echo $profile->name; ?>
	</div>
	<br><br>
	<div class="entry">
		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->deskripsi;
			$this->endWidget();
		?>
	</div>
	<div class="datebox right">
		<?php echo date('H:i:s - D, d F Y',$data->update_time); ?>
	</div>
		<div class="clear"></div>
</div>
<hr />
