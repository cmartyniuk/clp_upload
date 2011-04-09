<?php
	Configure::write('debug', 0);
	echo $content_for_layout;
	echo $scripts_for_layout; // this is hacky, but we have to add the callback script with inline=false so jake2 can wrap it in jquery/$, but we include it here also
		// for when we're not running in jake2 so it will be included 
?>