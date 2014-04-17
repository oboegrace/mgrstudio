<?php 

include_once( 'admin/controller/adminController.php' );

class websiteController extends adminController {
	public function ajax_saveXmlColumn() {
		$this->model->saveXmlColumn();
	}
	public function ajax_getXmlColumn() {
		$this->model->getXmlColumn();
	}
}

?>