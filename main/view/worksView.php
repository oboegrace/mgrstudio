<?php 

include_once( 'main/view/mainView.php' );

class worksView extends mainView {

	public function iniPage( &$wrapper ) {
	}
	public function displayContent() {
		// Get Data from Model
		
		// DisplayContent
		require( $this->templateFolder.'works.php' );
	}
}

?>