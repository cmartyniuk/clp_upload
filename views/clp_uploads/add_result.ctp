<?php
?>
	<div id="output"><?= $output ?></div>
	<div id="message"><?= $message ?></div>
	
<?php 

	echo $html->scriptStart(array('inline' => false)); ?>
		
		if (window.parent) {
			window.parent.gotFileId(<?= $uploadId ?>);
		}
					
<?php

	echo $html->scriptEnd();
?>