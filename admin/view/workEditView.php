<?php 

include_once( 'admin/view/adminView.php' );

class workEditView extends adminView {

	public function initPage(&$wrapper){
		$wrapper-> addCss($this->cssFolder.'bootstrap.min.css');
		$wrapper-> addJs($this->jsFolder.'workEdit.js');
		$wrapper->addJs('system/js/AjaxRequest.js');
	}
	public function displayContent() {
		// Get Data from Model
		$workData = $this->model->getWorkData();
		$errorMsg = $this->model->getErrorMsg();
		$tagList  = $this->model->getTagList();

		// DisplayContent
		require( $this->templateFolder.'workEdit.php' );
	}
}
?>