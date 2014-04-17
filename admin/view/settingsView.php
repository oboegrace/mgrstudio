<?php 

include_once( 'admin/view/adminView.php' );

class settingsView extends adminView {

	public function displayContent() {

		// Get Data from Model
		$themplateFolder = $this->getTemplateFolder();

		// DisplayContent
		require( $themplateFolder.'settings.php' );
	}
}
?>