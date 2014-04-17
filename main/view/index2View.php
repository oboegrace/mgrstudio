<?php 

include_once( 'main/view/mainView.php' );

class index2View extends mainView {
	public function iniPage( &$wrapper ) {
		$jsFolder = $this->getJsFolder();
		$wrapper->addJs($jsFolder.'index.js');
	}
	public function displayContent() {

		$themplateFolder = $this->getTemplateFolder();

		// Get Data from Model
		// $c = $this->model->getLangXmlContent( 'all' ); // CONTENT (XML)
		
		// DisplayContent
		require( $themplateFolder.'index2.php' );
	}
}

?>