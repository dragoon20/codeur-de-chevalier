<div class="materi">
	<div class="title">
		<div class="datebox">
			<span class="month"><?php echo date('M',$data->update_time); ?></span>
			<span class="date"><?php echo date('d',$data->update_time); ?></span>
		</div>
		<h2><?php echo CHtml::encode($data->judul);
			  $profile=Profiles::model()->findByAttributes(array('user_id'=>$data->user_id));
		?></h2>
	</div>
	
	<div class="cover">
		<div class="entry">
			<?php
				$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
				echo $data->deskripsi;
				$this->endWidget();
			?>
		</div>
		<div class="clear"></div>
	</div>
	<?php echo CHtml::link("Ubah Data","change_data_kuliah/".$data->materi_id); ?>
	<?php echo CHtml::link("Ubah Template","change_template/".$data->materi_id); ?>
</div>
<hr />
