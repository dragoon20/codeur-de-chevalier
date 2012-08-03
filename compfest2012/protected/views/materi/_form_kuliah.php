<div class="form" style="margin-left:20px;">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'materi-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<div class="left" style="width:100px;"> <?php echo $form->label($model,'judul'); ?> </div>
		<div class="left"> <?php echo $form->textField($model,'judul',array('size'=>60,'maxlength'=>128)); ?> </div>
		<div class="left" style="margin-left:8px;"> <?php echo $form->error($model,'judul'); ?> </div>
	</div>
	<div class="clear"> </div>
	<div class="row">
		<div class="left" style="width:100px; "> <?php echo $form->label($model,'deskripsi'); ?> </div>
		<div class="left"> <?php echo $form->textField($model,'deskripsi',array('size'=>70)); ?> </div>
		<div class="left" style="margin-left:8px;"><?php echo $form->error($model,'deskripsi'); ?> </div>
	</div>
	<div class="clear"> </div>
	
	<?php 
		/*
	<div class="row">
		<div class="left" style="width:100px; "> <?php echo $form->label($model,'urutan'); ?> </div>
		<div class="left"> <?php echo $form->textField($model,'urutan'); ?> </div>
		<div class="left" style="margin-left:8px;"><?php echo $form->error($model,'urutan'); ?> </div>
	</div>
	<div class="clear"> </div>
		*/
	?>
	
	<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
		tinyMCE.init({
	        // General options
	        mode : "textareas",
	        theme : "advanced",
	        plugins : "autolink,lists,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,preview,media,contextmenu,fullscreen,noneditable,nonbreaking,xhtmlxtras,template",
	
	        // Theme options
	        theme_advanced_buttons1 : "styleselect,formatselect,|,tablecontrols,|,preview,code,fullscreen,|,charmap,emotions,iespell,media,advhr,",
	        theme_advanced_buttons2 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,|,forecolor,backcolor,|,hr,sub,sup,|,image,|,fontselect,fontsizeselect,|,outdent,indent,",
	        theme_advanced_buttons3 : "",
	        theme_advanced_buttons4 : "",
	
			theme_advanced_toolbar_location : "top",
	        theme_advanced_toolbar_align : "left",
	        //theme_advanced_statusbar_location : "bottom",
	        theme_advanced_resizing : true,
	
	        // Skin options
	        skin : "o2k7",
	        skin_variant : "silver",
	
	        // Example content CSS (should be your site CSS)
	        //content_css : "<?php echo Yii::app()->request->baseUrl; ?>/css/style.css",
	
	        // Drop lists for link/image/media/template dialogs
	        template_external_list_url : "<?php echo Yii::app()->request->baseUrl; ?>/js/template_list.js",
	        external_link_list_url : "<?php echo Yii::app()->request->baseUrl; ?>/js/link_list.js",
	        external_image_list_url : "<?php echo Yii::app()->request->baseUrl; ?>/js/image_list.js",
	        media_external_list_url : "<?php echo Yii::app()->request->baseUrl; ?>/js/media_list.js",
	
	        // Replace values for the template plugin
	        template_replace_values : {
	                username : "Some User",
	                staffid : "991234"
	        }
	});
	</script>
	
	<div class="row">
		<div class="left" style="width:100px; "> <?php echo $form->label($model2,'isi_kuliah'); ?> </div>
		<div class="left"> <?php echo $form->textArea($model2,'isi_kuliah',array('rows'=>8, 'cols'=>70)); ?> </div>
		<div class="left" style="margin-left:8px;"><?php echo $form->error($model2,'isi_kuliah'); ?> </div>
	</div>
	<div class="clear"> </div>
	<div class="left" style="width:100px;">&nbsp;</div>
	<div class="row submit">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Buat' : 'Simpan'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->