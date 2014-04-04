<?php 

include_once( 'system/SiteView.php' );


class mainView extends SiteView {

	protected $templateFolder = '';
	protected $cssFolder = '';
	protected $imgFolder = '';
	protected $jsFolder  = '';

	// Display
	public function display() {
		
		// Vars
		$this->templateFolder = $this->getTemplateFolder();
		$this->cssFolder 	  = $this->getCssFolder();
		$this->imgFolder	  = $this->getImgFolder();
		$this->jsFolder 	  = $this->getJsFolder();

		// All Site Content (XML)
		$c = $this->model->getContentData();

		// Get Data from Model
		$pageName = $this->model->getPageName();

		// Wrapper
		$wrapper = new HtmlWrapper();
		$wrapper->setTitle( SITE_NAME );
		$wrapper->setBaseHref( SETTING_BASEHREF );
		$wrapper->addCss( 'system/fonts/font-awesome.css' );
		$wrapper->addCss( SETTING_BASEHREF.'system/css/base.css' );
		$wrapper->addCss( SETTING_BASEHREF.'system/css/skeleton_large.css' );
		//$wrapper->addCss( 'system/css/1140.css' );
		$wrapper->addCss( $this->cssFolder.'all.css' );
		$wrapper->addCss( $this->cssFolder.$pageName.'.css' );

		// Ini Content ( set styles & js by wrapper )
		$this->initPage( $wrapper );

		// Html Start
		echo $wrapper->getHtmlStart();
		echo '<div id="wrapper">';

		// Header
		include( $this->templateFolder.'header.php' );

		// Content
		$this->displayContent();

		// Footer
		include( $this->templateFolder.'footer.php' );

		// Html End
		echo '</div>';
		echo $wrapper->getHtmlEnd();
	}

	// Abstract Functions ( override by pageview )
	public function initPage( &$wrapper ) {}
	public function displayContent() {}
}

?>