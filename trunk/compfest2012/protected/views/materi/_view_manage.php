<div class="materi">
	<div class="link_blue right">
		<?php echo CHtml::link("Ubah Data","change_data_kuliah/".$data->materi_id); ?>
	</div>
	<div class="link_blue right">
		<?php echo CHtml::link("Ubah Template","change_template/".$data->materi_id); ?>
	</div>
	
	<div class="title">
		<h1><?php echo CHtml::link(CHtml::encode($data->judul), "view/".$data->materi_id);
			  $profile=Profiles::model()->findByAttributes(array('user_id'=>$data->user_id));
		?>
		</h1>
	</div>

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
