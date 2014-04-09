<?php 

include_once( 'admin/controller/adminController.php' );

class loginController extends adminController {
	public function action_login(){
		$this->model->login();
	}
}

?>