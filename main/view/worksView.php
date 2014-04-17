<?php 

include_once( 'main/view/mainView.php' );

class worksView extends mainView {

	public function initPage( &$wrapper ) {
		$wrapper->addCss( $this->cssFolder.'component/workItem.css' );
	}
	public function displayContent() {
		// Get Data from Model
		$worksList = $this->model->getWorksList();
		
		// pagination
		$pageCount = $this->model->getPageCount();
		$currentPage = $this->model->getCurrentPage();
		$currentCategory = strtoupper($this->model->getCurrentCategory());
		// DisplayContent
		require( $this->templateFolder.'works.php' );
	}
}

?>