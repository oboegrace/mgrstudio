<?php 

include_once( 'admin/view/adminView.php' );

class workEditView extends adminView {

	public function displayContent() {
		
		// Get Data from Model
		$templateFolder = $this->getTemplateFolder();
		// $newsList = $this->model->getNewsList();//在newsModel implement
		$workData = $this->model->getWorkData();
		// DisplayContent
		require( $templateFolder.'workEdit.php' );
	}
}
?>