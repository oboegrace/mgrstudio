<?php 

include_once( 'main/view/mainView.php' );

class indexView extends mainView {
	public function initPage( &$wrapper ) {
		$wrapper->addJs($this->jsFolder.'index.js');
	}
	public function displayContent() {
		// Get Data from Model
		
		// DisplayContent
		require( $this->templateFolder.'index.php' );
	}
}

?>