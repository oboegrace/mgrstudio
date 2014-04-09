<?php 

include_once( 'main/view/mainView.php' );

class newsView extends mainView {
	
	public function initPage( &$wrapper ) {
	}
	public function displayContent() {

		// Get Data from Model
		$newsItems = $this->model->getNewsItems();
		$pageCount = $this->model->getPageCount();
		$currentPage = $this->model->getCurrentPage();
		// DisplayContent
		require( $this->templateFolder.'news.php' );
	}
}

?>