<?php 

include_once( 'main/view/mainView.php' );

class workView extends mainView {

	public function iniPage( &$wrapper ) {
	}
	public function displayContent() {
		
		// Get Data from Model
		
		// DisplayContent
		require( $this->templateFolder.'work.php' );
	}
}

?>