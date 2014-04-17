<?php 

include_once( 'main/controller/mainController.php' );

class workController extends mainController {

	function __construct( $model, $pathElements ) {
		$this->model = $model;
		$this->pathElements = $pathElements;

		if ( isset($pathElements[0]) ) {
			$id = $pathElements[0];
			$this->model->setWorkId( $id );
		}
	}
}

?>