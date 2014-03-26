<?php 

include_once( 'admin/controller/adminController.php' );

class newsEditController extends adminController {
	public function action_saveData(){
		$this->model->saveData();
	}
	public function action_addData(){
		$this->model->addData();
	}	

}

?>