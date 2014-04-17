<?php 

include_once( 'system/Controller.php' );

class adminController extends Controller {
	// function __construct( $model, $pathElements ) {
	// 	$this->model = $model;
	// 	$this->pathElements = $pathElements;
	// }
	public function action_logout(){
		$this->model->logout();
	}

}

?>