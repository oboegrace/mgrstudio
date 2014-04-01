<?php 

include_once( 'admin/view/adminView.php' );
// worksView: 跟model拿變數 交給template去用
class worksView extends adminView {
	
	public function iniPage(&$wrapper){
		$styleFolder = $this->getStyleFolder();
		$wrapper-> addCss($styleFolder.'bootstrap.min.css');
		$jsFolder = $this->getJsFolder();
		$wrapper-> addJs($jsFolder.'works.js');
	}
	
	public function displayContent() {
		// Get Data from Model
		$themplateFolder = $this->getTemplateFolder();
		$worksList = $this->model->getWorksList();//在worksModel implement
		// DisplayContent
		require( $themplateFolder.'works.php' );
	}
}
?>