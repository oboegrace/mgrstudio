<?php 

include_once( 'admin/controller/adminController.php' );

class worksController extends adminController {
	public function action_deleteWorks(){
		$this->model->deleteWorks();
	}
}

?>