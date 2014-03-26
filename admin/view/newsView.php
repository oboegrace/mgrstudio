<?php 

include_once( 'admin/view/adminView.php' );
// newsView: 跟model拿變數 交給template去用
class newsView extends adminView {

	public function iniPage(&$wrapper){
		$jsFolder = $this->getJsFolder();
		$wrapper-> addJs($jsFolder.'news.js');
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