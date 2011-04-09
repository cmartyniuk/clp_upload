<?php
class ClpUpload extends ClpUploadAppModel {
	var $name = 'ClpUpload';
	var $displayField = 'basename';
	
	//media plugin behaviors
	var $actsAs = array(
		'Media.Transfer',
		'Media.Coupler',
//		'Media.Generator'
	);

	//file validation which only allowed jpeg and png to be uploaded
	var $validate = array();
	
	var $uploadClasses = array(
		'image' => array(
			'name' => 'image',
			'allowedExtensions' => 'jpg|jpeg|gif|png',
			'validate' => array(
				'file' => array(
					'mimeType' => array(
						'rule' => array('checkMimeType', false, array( 'image/jpeg', 'image/png', 'image/gif')),
						'message' => 'The file contents were not recognized as a valid image file. Try a different file.'
					),
					'size' => array(
						'rule' => array('checkSize', '2M'),
						'message' => 'The file size is too large. Try a smaller file.'
					)
				)
			)
		),
		'audio' => array(
			'name' => 'audio',
			'allowedExtensions' => 'mp3|mpg',
			'validate' => array(
				'file' => array(
					'mimeType' => array(
						'rule' => array('checkMimeType', false, array( 'audio/mpeg', 'audio/x-mpeg', 'audio/mp3', 'audio/x-mp3', 'audio/mpeg3', 'audio/x-mpeg3', 'audio/mpg', 'audio/x-mpg', 'audio/x-mpegaudio', 'application/octet-stream')),
						'message' => 'The file contents were not recognized as a valid MP3 audio file. Try a different file.'
					),
					'size' => array(
						'rule' => array('checkSize', '8M'),
						'message' => 'The file size is too large. Try a smaller file.'
					)
				)
			)
		)
	);

	var $uploadClass = array();
	
	function __construct( $id = false, $table = NULL, $ds = NULL ) {
		parent::__construct($id, $table, $ds);
		
		$this->setUploadClass('image'); // default is image
	}
		
	function setUploadClass($class) {
	
		if (isset($this->uploadClasses[$class])) {

			// reset validation, then reattach behaviour to reset it
			
			$this->uploadClass = $this->uploadClasses[$class];
			$this->validate = $this->uploadClass['validate'];		

			$this->Behaviors->attach('Media.Transfer');		

		}	
	
	}

}
?>