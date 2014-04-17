<?php 

include_once( 'admin/controller/adminController.php' );

class loginController extends adminController {
	public function action_login(){
		$username = trim($_POST['user']);
		$password = trim($_POST['password']);

		$loginResult = $this->model->login( $username, $password );
		if ( $loginResult ) {
			header( 'location: '.DIR_ROOT.'/admin/' );
		}
	}
}

?>