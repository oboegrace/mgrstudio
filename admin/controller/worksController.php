<?php 

include_once( 'admin/controller/adminController.php' );

class worksController extends adminController {
	
	// for pagination (set current page)
	function __construct( $model, $pathElements ) {
		$this->model = $model;
		$this->pathElements = $pathElements;
		//var_dump($pathElements);
		if (isset($pathElements[0]))
			$this->model->setCurrentPage($pathElements[0]);
	}

	public function action_deleteWorks(){
		$this->model->deleteWorks();
	}
}

?>