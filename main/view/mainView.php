<?php 

include_once( 'system/SiteView.php' );


class mainView extends SiteView {

	// Display
	public function display() {
		// Vars
		$templateFolder = $this->getTemplateFolder();
		$styleFolder 	= $this->getStyleFolder();
		$imageFolder	= $this->getImageFolder();

		// Content (XML)
		$c = $this->model->getContentData();

		// Get Data from Model
		$pageName = $this->model->getPageName();

		// Wrapper
		$wrapper = new HtmlWrapper();
		$wrapper->setTitle( SITE_NAME );
		$wrapper->setBaseHref( SETTING_BASEHREF );
		$wrapper->addCss( SETTING_BASEHREF.'system/fonts/font-awesome.css' );
		$wrapper->addCss( SETTING_BASEHREF.'system/css/base.css' );
		$wrapper->addCss( SETTING_BASEHREF.'system/css/skeleton.css' );
		$wrapper->addCss( SETTING_BASEHREF.'system/css/layout.css' );
		$wrapper->addCss( $styleFolder.'all.css' );
		$wrapper->addCss( $styleFolder.$pageName.'.css' );

		// Ini Content ( set styles & js by wrapper )
		$this->iniPage( $wrapper );

		// Html Start
		echo $wrapper->getHtmlStart();
		echo '<div id="wrapper">';

		// Header
		include( $templateFolder.'header.php' );

		// Content
		$this->displayContent();

		// Footer
		include( $templateFolder.'footer.php' );

		// Html End
		echo '</div>';
		echo $wrapper->getHtmlEnd();
	}

	// Abstract Functions ( override by pageview )
	public function iniPage( &$wrapper ) {}
	public function displayContent() {}
}

?>