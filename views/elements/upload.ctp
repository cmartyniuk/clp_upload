<?php 
	echo $html->script('/clp_upload/js/jquery.ba-resize.js', false);
	echo $html->script('/clp_upload/js/jquery.iframe-auto-height.plugin.js', false);
	echo $html->scriptStart(array('inline' => false)); ?>

		$(document).ready(function() {
		
			$('#<?= $name?>').iframeAutoHeight({heightOffset:5});	

		});

<?php

	echo $html->scriptEnd();

	if (!empty($errors[$name])) {	
		$errMsg = $this->Form->error($name, $errors[$name], array());
	} else {
		$errMsg = null;
	}
	
?>	
<div class="input text <?= $errMsg ? 'error' : '' ?>">
	<label for="<?= $name ?>"><?= $label ?></label>
	
	<?php 
		echo $this->Form->hidden($name);
	
		$fieldAttribs = $html->_initInputField($name);
		
		$fieldAttribs2 = $html->_initInputField($association . '.id');

	?>
	
	<iframe id="<?= $name ?>" class="" scrolling="no" style="height:0px;width:500px;" src="<?= $this->Html->iframeUrl(array(
	    'controller' => 'ClpUploads',
	    'action' => 'add',
	    'plugin' => 'clp_upload',
	    'uploadClass' => $uploadClass,
	    'id' => $fieldAttribs2['value'],
	    'iframeID' => $fieldAttribs['id']));?>" ></iframe>

	<?php echo isset($after) ? $after : null; ?>
	<?php echo $errMsg; ?>
	
</div>

<?php

?>