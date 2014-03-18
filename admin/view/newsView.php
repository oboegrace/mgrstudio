<?php 

include_once( 'admin/view/adminView.php' );

class newsView extends adminView {

	public function displayContent() {
		
		// Get Data from Model
		$themplateFolder = $this->getTemplateFolder();

		// DisplayContent
		require( $themplateFolder.'news.php' );
	}
}
?>