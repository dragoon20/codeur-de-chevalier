<div id="container">
	<div id="judul">
		<?php echo $model->judul; ?>
	</div>
	<div id="materi_kuliah">
		<?php echo $isi->isi_kuliah; ?>
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
		$("#container").attr("style","position:absolute; background-image:url('<?php echo Yii::app()->baseUrl."/images/".$template->background_link; ?>'); width:"+screen.width+"px; height:"+screen.height+"px;");
		$("#robot").attr("style","position:absolute; top: <?php echo $template->icon_y-200; ?>px; left: <?php echo $template->icon_x; ?>px;");
		$("#judul").attr("style","position:absolute; top: <?php echo $template->judul_y; ?>px; left: <?php echo $template->judul_x; ?>px;");
		$("#materi_kuliah").attr("style","position:absolute; top: <?php echo $template->isi_y; ?>px; left: <?php echo $template->isi_x; ?>px;");
	});
</script>