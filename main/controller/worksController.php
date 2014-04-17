<?php 

include_once( 'main/controller/mainController.php' );

class worksController extends mainController {
	
	// for pagination (set current page)
	function __construct( $model, $pathElements ) {
		$this->model = $model;
		$this->pathElements = $pathElements;
		// var_dump($pathElements);
		// .../works/webvideo/2
		// array(2) { [0]=> string(8) "webvideo" [1]=> string(1) "2" }

		// URL TAG 
		if (isset($pathElements[0]))
			$this->model->setCurrentCategory(strtolower($pathElements[0]));
		// URL PAGE 
		if (isset($pathElements[1]))
			$this->model->setCurrentPage($pathElements[1]);

	}
}

?>