<div id="container">
	<div id="judul">
		<?php echo $model->judul; ?>
	</div>
	<div id="materi_kuliah">
		<?php echo $isi->isi_kuliah; ?>
	</div>
	<div id="robot">
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function()
	{
		//set background
		$("#container").attr("style","background-image:url('<?php echo $template->background_link; ?>'); width:100%; height:100%;");
		$("#robot").attr("style","position:absolute; top: <?php echo $template->icon_y; ?>px; left: <?php echo $template->icon_x; ?>px;");
		$("#judul").attr("style","position:absolute; top: <?php echo $template->judul_y; ?>px; left: <?php echo $template->judul_x; ?>px;");
		$("#materi_kuliah").attr("style","position:absolute; top: <?php echo $template->isi_y; ?>px; left: <?php echo $template->isi_x; ?>px;");
	});
</script>