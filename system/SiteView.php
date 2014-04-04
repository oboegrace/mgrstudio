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
	public function getCssFolder() {
		$siteName = $this->model->getSiteName();
		$folder = $siteName.'/view/theme/'.$this->theme.'/css/';
		return $folder;
	}
	public function getImgFolder() {
		$siteName = $this->model->getSiteName();
		$folder = $siteName.'/view/theme/'.$this->theme.'/img/';
		return $folder;
	}

	public function getJsFolder() {
		$siteName = $this->model->getSiteName();
		$folder = $siteName.'/view/theme/'.$this->theme.'/js/';
		return $folder;
	}
	public function getThemeFolder() {
		$siteName = $this->model->getSiteName();
		$folder = $siteName.'/view/theme/'.$this->theme.'/';
		return $folder;
	}
}

?>