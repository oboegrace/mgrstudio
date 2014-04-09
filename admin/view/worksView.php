<?php 

include_once( 'admin/view/adminView.php' );
// worksView: 跟model拿變數 交給template去用
class worksView extends adminView {
	
	public function initPage(&$wrapper){
		$wrapper-> addCss( $this->cssFolder.'bootstrap.min.css' );
		$wrapper-> addJs( $this->jsFolder.'works.js' );
	}
	
	public function displayContent() {
		// Get Data from Model
		$themplateFolder = $this->getTemplateFolder();
		$worksList = $this->model->getWorksList();//在worksModel implement
		
		// pagination
		$pageCount = $this->model->getPageCount();
		$currentPage = $this->model->getCurrentPage();

		// DisplayContent
		require( $themplateFolder.'works.php' );
	}
}
?>