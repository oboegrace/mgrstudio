<?php 

include_once( 'admin/controller/adminController.php' );

class workEditController extends adminController {
	public function action_saveData(){
		$this->model->saveData();
	}
	public function action_addData(){
		$this->model->addData();
	}	
	public function ajax_uploadImage(){
		$tempPath = $this->model->uploadTempImage($_FILES['file']);
		echo $tempPath;
	}

}

?>