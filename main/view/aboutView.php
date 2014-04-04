<?php 

include_once( 'main/view/mainView.php' );

class aboutView extends mainView {

	public function initPage( &$wrapper ) {
	}
	public function displayContent() {

		// Get Data from Model
		$content1 = $this->model->getContent1();
		$content2 = $this->model->getContent2();
		
		// DisplayContent
		require( $this->templateFolder.'about.php' );
	}
}

?>