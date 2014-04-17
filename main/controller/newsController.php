<?php 

include_once( 'main/controller/mainController.php' );

class newsController extends mainController {
	function __construct( $model, $pathElements ) {
		$this->model = $model;
		$this->pathElements = $pathElements;
		//var_dump($pathElements);
		if (isset($pathElements[0]))
			$this->model->setCurrentPage($pathElements[0]);
	}
}

?>