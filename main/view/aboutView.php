<?php 

include_once( 'main/view/mainView.php' );

class aboutView extends mainView {
	public function iniPage( &$wrapper ) {
		$styleFolder = $this->getStyleFolder();
		$wrapper->addCss($styleFolder.'about.css');
	}
	public function displayContent() {

		$themplateFolder = $this->getTemplateFolder();

		// Get Data from Model
		// $c = $this->model->getLangXmlContent( 'all' ); // CONTENT (XML)
		
		// DisplayContent
		require( $themplateFolder.'about.php' );
	}
}

?>