<?php 

include_once( 'admin/view/adminView.php' );
// newsView: 跟model拿變數 交給template去用
class newsView extends adminView {

	public function initPage( &$wrapper ){
		$wrapper-> addCss( $this->cssFolder.'bootstrap.min.css' );
		$wrapper-> addJs( $this->jsFolder.'news.js' );
	}
	public function displayContent() {
		
		// Get Data from Model
		$templateFolder = $this->getTemplateFolder();
		$newsList = $this->model->getNewsList();//在newsModel implement
		// DisplayContent
		require( $templateFolder.'news.php' );
	}
}
?>