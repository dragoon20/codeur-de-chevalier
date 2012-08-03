<hr />
	<div id="outer_container" style="width:800px; height:200px; margin:auto;">
		<div id="inner_container" style="height:200px; background-color:blue;">
			<?php
				foreach($template as $temp)
				{
					echo '<div class="item';
					if ($model->template_id == $temp->id_template)
						echo ' choosen';
					echo '" style="height:180px; background-color:yellow; width:300px;">';
					echo '<img src="'.$temp->preview_link.'" onclick="choose('.$temp->id_template.')"/>';
					echo '</div>';
				}
			?>
		</div>
	</div>
<hr />
<div id="image" style="width:600px; height:400px; background-color:green; margin:auto;">
	<img />
</div>
<div class="form">
	<?php echo CHtml::beginForm(); ?>
		<input id="choosen" type="hidden" value="<?php $model->template_id ?>"></input>
		<div class="row submit">
			<?php echo CHtml::submitButton('Pilih'); ?>
		</div>
	<?php echo CHtml::endForm(); ?>
</div><!-- form -->
<script>
	$(document).ready(function ()
	{
		var left = 0;
		var post_awal = $("#inner_container").position().left;
		var cont_post = $("#inner_container").position();
		var items_width = $(".item").width();
		var items = $("#inner_container > div.item").length;
		var post_akhir = (post_awal + (items-3)*(items_width))*-1;
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
						left: '+=' + moveLeft
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
				if (left+moveLeft >= post_awal)
				{
					moveLeft = Math.abs(post_awal - cont_post_temp);
					left = post_awal;
					$("#inner_container").animate(
					{
						left: '-=' + moveLeft
					},500, function() {
						$("#inner_container").draggable("option","revert",true);
						cont_post = $("#inner_container").position();
						$("#inner_container").bind('mouseup', function() {bindMouseUp();});
					});
				}
				else
				{
					left = cont_post_temp + moveLeft;
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
		
		function choose(i) {
			alert("A");
			$(".item").removeClass('choosen');
			var src = $(this).children("img").attr("src");
			$("#choosen").val(i);
			$(this).addClass('choosen');
			$("#image").children("img").attr("src",src);
		};
		
	});
</script>