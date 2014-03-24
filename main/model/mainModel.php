<?php 

include_once( 'system/SiteModel.php' );

class mainModel extends SiteModel {

	private $contentData;

	function __construct() {
		parent::__construct();

		// Var
		$this->siteName = 'main';
		$this->baseHref = '';
		
		// Data
		$this->contentData = $this->getXmlContentData( 'all' );
	}
<<<<<<< HEAD
	public function getContentData(){
=======
	public function getContentData() {
>>>>>>> FETCH_HEAD
		return $this->contentData;
	}
}

?>