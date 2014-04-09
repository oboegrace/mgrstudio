<?php 

include_once( 'admin/controller/adminController.php' );

class newsEditController extends adminController {
	public function action_saveData(){
		$this->model->saveData();
	}
	public function action_addData(){
		$this->model->addData();
	}	
	public function ajax_uploadImage(){
		$tempPath = $this->model->uploadTempImage($_FILES['file']);
//		echo $_FILES["file"]["tmp_name"];
		echo $tempPath;	//透過echo 讓js取得
		// exit();
	}

}

?>