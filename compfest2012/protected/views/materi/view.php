<div id="container">
	<div id="judul">
		<?php echo $model->judul; ?>
	</div>
	<div id="materi_kuliah">
		<?php 
			if ($model->materi_type==1)
			{
				echo "<div style='width:600px; height:400px;'>";
				echo $isi->isi_kuliah; 
				echo "</div>";
			}
			else if ($model->materi_type==2)
			{
				echo '<iframe src="http://docs.google.com/gview?url='.$isi->link_pp.'&embedded=true" style="width:600px; height:400px;" frameborder="0">';
				echo "</iframe>";
			}
		?>
	</div>
	<div id="robot">
		<canvas id="myCanvas" width="300" height="380">
			Your browser does not support the canvas element.
		</canvas>
	</div>
</div>
<script type="text/javascript" src="<?php echo Yii::app()->baseUrl ?>/js/compfest.js" ></script>
<script type="text/javascript">
	$(document).ready(function()
	{
		//set background
		
	initialization();
	loadImages(sources, function (){});
		start1(<?php echo $template->icon_y; ?>);
		$("#container").attr("style","position:absolute; background-image:url('<?php echo Yii::app()->baseUrl."/images/".$template->background_link; ?>'); width:100%; height:100%;");
		$("#robot").attr("style","position:absolute; top: <?php echo $template->icon_y-200; ?>px; left: <?php echo $template->icon_x; ?>px;");
		$("#judul").attr("style","position:absolute; top: <?php echo $template->judul_y; ?>px; left: <?php echo $template->judul_x; ?>px;");
		$("#materi_kuliah").attr("style","position:absolute; top: <?php echo $template->isi_y; ?>px; left: <?php echo $template->isi_x; ?>px;");
	});
</script>