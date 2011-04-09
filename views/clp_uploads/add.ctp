<?php
	echo $html->script(array('http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js', 'jquery-ui.js', 'jquery-fluid16.js'), false);
	echo $html->script('/clp_upload/js/jquery.fileUploader', false);
	echo $html->css('/clp_upload/css/fileUploader', null, array('inline' => false));
?>
 
<div class="uploads form">
	<?php if (!$iframeID): ?>
	<h2><?php __('Upload Photo');?></h2>
	<?php endif; ?>
	<?php
		echo $form->create('ClpUpload', array('type' => 'file', 'url' => array(
	    'controller' => 'ClpUploads',
	    'plugin' => 'clp_upload',
	    'action' => 'add',
	    'uploadClass' => $params['uploadClass'],
		)));
		echo $form->input('file', array('type' => 'file', 'label' => false, 'class' => 'imageUpload'));
		echo $form->end();
	?>
	<br />
	<input type="submit" value="ClpUpload" id="pxUpload" disabled="disabled" style="display:none;" />
	<input type="reset" value="X" id="pxClear" disabled="disabled" />
</div>
<div style="clear:both;"></div> 

<?php
	
		echo $html->scriptStart(array('inline' => false)); 

?>
	$(function(){
		$('.imageUpload').fileUploader({
			imageLoader: '<?php echo $html->url('/img/image_upload.gif'); ?>',
			allowedExtension: '<?= $allowedExtensions ?>',
			limit: 1,
			autoUpload: true,
			currentFile: '<?= !empty($data) ? $data['ClpUpload']['basename'] : '' ?>',
			completed: function(e) {
//				console.log( $(e).contents().find("#message").text() );
			},
			cleared: function(e) {
//				console.log( $(e).contents().find("#message").text() );
				gotFileId(null);
			}
		});
	});
	
	<?php if ($iframeID): ?>
	
	function gotFileId(id) {

		if (window.parent) {
			$('#<?= $form->defaultModel . $iframeID ?>', window.parent.document).val(id);
	
			if (id) {
				$('#<?= $form->defaultModel . $iframeID ?>', window.parent.document).parent().removeClass('error');
				$('#<?= $form->defaultModel . $iframeID ?>', window.parent.document).parent().find('.error-message').remove();
			}
							
		}

	};
		
	<?php endif; ?>

<?php
	
		echo $html->scriptEnd(); 

?>