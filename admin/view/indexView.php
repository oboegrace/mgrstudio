<?php 

include_once( 'admin/view/adminView.php' );

class indexView extends adminView {

	public function displayContent() {
		// Get Data from Model
		$themplateFolder = $this->getTemplateFolder();

		// DisplayContent
		require( $themplateFolder.'index.php' );
	}
}
?>