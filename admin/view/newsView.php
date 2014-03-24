<?php 

include_once( 'admin/view/adminView.php' );

class newsView extends adminView {

	public function displayContent() {
		
		// Get Data from Model
		$templateFolder = $this->getTemplateFolder();
		$newsList = $this->model->getNewsList();

		// [0]['title']
		// [1]['title']


		// DisplayContent
		require( $templateFolder.'news.php' );
	}
}
?>