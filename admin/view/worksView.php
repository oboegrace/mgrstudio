<?php 

include_once( 'admin/view/adminView.php' );

class worksView extends adminView {

	public function displayContent() {

		// Get Data from Model
		$themplateFolder = $this->getTemplateFolder();

		// DisplayContent
		require( $themplateFolder.'works.php' );
	}
}
?>