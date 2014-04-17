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
		//echo "var_dump:";
		//var_dump($_FILES['file']);
		$tempPath = $this->model->uploadTempImage($_FILES['file']);
		echo $tempPath;
		//echo "tempPath:".$tempPath;//return error file type?
	}

}

?>