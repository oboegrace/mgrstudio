<?php 

include_once( 'admin/view/adminView.php' );

class workEditView extends adminView {

	public function initPage(&$wrapper){
		$wrapper-> addCss($this->cssFolder.'bootstrap.min.css');
	}
	public function displayContent() {
		// Get Data from Model
		$workData = $this->model->getWorkData();
		$errorMsg = $this->model->getErrorMsg();

		// DisplayContent
		require( $this->templateFolder.'workEdit.php' );
	}
}
?>