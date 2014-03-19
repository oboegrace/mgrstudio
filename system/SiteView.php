<?php
include_once( 'system/View.php' );
include_once( 'system/HtmlWrapper.php' );
// echo "siteView.php loadded";
abstract class SiteView extends View {

	protected $theme = 'default';

	function __construct( $model ) {
		parent::__construct( $model );
	}
	
	// Display ( override by sub siteView )
	// main display function, echo every thing in here
	public function display() { } 

	// Get & Set
	public function getTemplateFolder() {
		$siteName = $this->model->getSiteName();
		$folder = $siteName.'/view/theme/'.$this->theme.'/template/';
		return $folder;
	}
	public function getStyleFolder() {
		$siteName = $this->model->getSiteName();
		$folder = $siteName.'/view/theme/'.$this->theme.'/style/';
		return $folder;
	}
	public function getImageFolder() {
		$siteName = $this->model->getSiteName();
		$folder = $siteName.'/view/theme/'.$this->theme.'/images/';
		return $folder;
	}
	public function getThemeFolder() {
		$siteName = $this->model->getSiteName();
		$folder = $siteName.'/view/theme/'.$this->theme.'/';
		return $folder;
	}
}

?>