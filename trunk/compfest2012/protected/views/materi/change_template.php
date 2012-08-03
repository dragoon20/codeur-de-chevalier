<?php
$this->breadcrumbs=array(
	'Materi'=>array('index'),
	'Edit'=>array('manage'),
	'Ubah Template',
);
?>
<hr />
	<div id="outer_container" style="width:800px; height:200px; margin:auto;">
		<div id="inner_container" style="height:200px;">
			<?php
				$i = 0;
				foreach($template as $temp)
				{
					$i++;
					echo '<a href="javascript:choose('.$temp->id_template.')">';
					echo '<div class="item';
					if ($model->template_id == $temp->id_template)
					{
						echo ' choosen';
						$src = Yii::app()->baseUrl."/images/preview/".$temp->preview_link;
					}
					echo '" style="height:180px; background-color:yellow; width:300px;">';
					echo '<img id="preview_'.$temp->id_template.'" src="'.Yii::app()->baseUrl."/images/preview/".$temp->preview_link.'" style="height:180px; width:300px;"/>';
					echo '</div>';
					echo '</a>';
				}
			?>
		</div>
	</div>
<hr />
<div id="image" style="width:600px; height:400px; margin:auto;">
	<img style="width:600px; height:400px;" src = "<?php echo $src; ?>"/>
</div>
<div class="form" style="width:100px;margin: auto; margin-top:20px;">
	<?php echo CHtml::beginForm(); ?>
		<input id="choosen" name="template_id" type="hidden" value="<?php $model->template_id ?>"></input>
		<div class="row submit">
			<?php echo CHtml::submitButton('Pilih'); ?>
		</div>
	<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<script>
	$(document).ready(function ()
	{
		var left = 0;
		var post_awal =0;
		var cont_post = $("#inner_container").position();
		var items_width = $(".item").width();
		var items = <?php echo $i; ?>;
		var post_akhir = (post_awal + (items-2)*(items_width))*-1;
		var cont_post_temp;
		
		$("#inner_container").draggable({axis:"x", revert:true});
		
		function bindMouseUp()
		{
			$("#inner_container").unbind('mouseup');
			cont_post_temp = $("#inner_container").position().left;
			if (cont_post.left > cont_post_temp )
			{
				// swipe to right
				$("#inner_container").draggable("option","revert",false);
				var moveLeft = Math.abs(cont_post.left - cont_post_temp);				
				if (left-moveLeft < post_akhir)
				{
					moveLeft = Math.abs(cont_post_temp - post_akhir);
					left = post_akhir;
					$("#inner_container").animate(
					{
						left: post_akhir+'px'
					},500, function() {
						$("#inner_container").draggable("option","revert",true);
						cont_post = $("#inner_container").position();
						$("#inner_container").bind('mouseup', function() {bindMouseUp();});
					});
				}
				else
				{
					left -= moveLeft*2;
					$("#inner_container").animate(
					{
						left: '-=' + moveLeft
					},500, function() {
						$("#inner_container").draggable("option","revert",true);
						cont_post = $("#inner_container").position();
						$("#inner_container").bind('mouseup', function() {bindMouseUp();});
					});
				}
			}
			else if (cont_post.left < cont_post_temp)
			{
				// swipe to left
				$("#inner_container").draggable("option","revert",false);
				var moveLeft = Math.abs(cont_post_temp - cont_post.left);
				if (left+moveLeft >= 0)
				{
					moveLeft = Math.abs(post_awal - cont_post_temp);
					left = 0;
					$("#inner_container").animate(
					{
						left: '0px'
					},500, function() {
						$("#inner_container").draggable("option","revert",true);
						cont_post = $("#inner_container").position();
						$("#inner_container").bind('mouseup', function() {bindMouseUp();});
					});
				}
				else
				{
					left += moveLeft*2;
					$("#inner_container").animate(
					{
						left: '+=' + moveLeft
					},500, function() {
						$("#inner_container").draggable("option","revert",true);
						cont_post = $("#inner_container").position();
						$("#inner_container").bind('mouseup', function() {bindMouseUp();});
					});
				}
			}
			else
			{
				// on the beginning or end item swipe
				$("#inner_container").draggable("option","revert",true);
				$("#inner_container").bind('mouseup', function() {bindMouseUp();});
			}
		} 
		
		$("#inner_container").mouseup(function() {
			bindMouseUp();
		});
		
	});
	function choose(i) {
		$(".item").removeClass('choosen');
		var src = $("#preview_"+i).attr("src");
		$("#choosen").val(i);
		$(this).addClass('choosen');
		$("#image").children("img").attr("src",src);
	};
</script>