<?php 

include_once( 'admin/view/adminView.php' );

class newsView extends adminView {

	public function displayContent() {
		
		// Get Data from Model
		$templateFolder = $this->getTemplateFolder();
		$newsList = $this->model->getNewsList();//在newsModel implement

		// [0]['title']
		// [1]['title'] get title only

		// DisplayContent
		require( $themplateFolder.'news.php' );
	}
}
?>