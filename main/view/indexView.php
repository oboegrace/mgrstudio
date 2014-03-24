<?php 

include_once( 'main/view/mainView.php' );

class indexView extends mainView {
	public function iniPage( &$wrapper ) {
		// $styleFolder = $this->getStyleFolder();
		// $wrapper->addCss($styleFolder.'index.css');
	}
	public function displayContent() {

		$themplateFolder = $this->getTemplateFolder();

		// Get Data from Model
		// $c = $this->model->getLangXmlContent( 'all' ); // CONTENT (XML)
		
		// DisplayContent
		require( $themplateFolder.'index.php' );
	}
}

?>