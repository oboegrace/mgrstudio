<?php 

include_once( 'admin/view/adminView.php' );
include_once( 'system/XmlEditor/XmlEditorView.php' );

class websiteView extends adminView {

	protected $subPageName = 'index';

	public function initPage( &$wrapper ) {
		$wrapper->addCss( $this->cssFolder.'website.css' );
		$wrapper->addCss( 'system/XmlEditor/XmlEditor.css' );
		$wrapper->addJs( 'system/XmlEditor/XmlEditor.js' );
	}

	public function displayContent() {

		// SubPageName (for submenu light)
		$this->subPageName = $this->model->getWebpageName();

		// Vars
		$themplateFolder = $this->getTemplateFolder();

		// Get Data from Model
		$webpageName 	= $this->model->getWebpageName();
		$xmlEditorModel = $this->model->getXmlEditorModel();

		// Xml Editor (View)
		$xmlEditorView = new XmlEditorView( $xmlEditorModel, 'content' );

		// DisplayContent
		require( $themplateFolder.'website.php' );
	}
}

?>