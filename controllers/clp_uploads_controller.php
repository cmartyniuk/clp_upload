<?php
class ClpUploadsController extends ClpUploadAppController {
 
	var $name = 'ClpUploads';
	var $components = array('RequestHandler');

	function beforeFilter() {
		parent::beforeFilter(); 
		
		$this->Auth->allow('*', '*', 'add');

	}
	
	function add() {
		
		if (!empty($this->params['named']['uploadClass'])) {
		
			$this->ClpUpload->setUploadClass($this->params['named']['uploadClass']);
		
		}
			
		if (!empty($this->data)) {
			if ($this->ClpUpload->save($this->data)) {
				
				$this->set('output', 'success');
				$this->set('message', '');
				$this->set('uploadId', $this->ClpUpload->getLastInsertID());
												
			} else {

				$this->set('output', 'Upload failed');
				$this->set('message', $this->ClpUpload->validationErrors['file']);
				$this->set('uploadId', 0);
			
			}

			// the uploader js places this in an iframe subordinate to the upload form

			$this->RequestHandler->ajaxLayout = 'ajaxy_inline';
			$this->RequestHandler->renderAs($this, 'ajax');
			$this->render('add_result');
						 
			return;
					
		} else {
		
			if (!empty($this->params['named']['iframeID'])) {

				$this->layout = $this->findLayout('iframe');
				$this->set('iframeID', $this->params['named']['iframeID']);

			}
				
		}
		
		if (!empty($this->params['named']['id'])) {
		
			$id = $this->params['named']['id'];

			$data = $this->ClpUpload->read(null, $id);
		
			$this->set('data', $data);
		
		}	
		
		$this->set('params', $this->params['named']);
		$this->set('allowedExtensions', $this->ClpUpload->uploadClass['allowedExtensions']);
		
	}
 
}
?>