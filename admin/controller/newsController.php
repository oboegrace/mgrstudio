<?php 

include_once( 'admin/controller/adminController.php' );

class newsController extends adminController {
	public function action_deleteNews(){
		$this->model->deleteNews();
	}
}

?>