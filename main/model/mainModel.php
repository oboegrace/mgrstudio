<?php 

include_once( 'system/SiteModel.php' );

class mainModel extends SiteModel {

	private $contentData;

	function __construct( $pageName ) {
		parent::__construct();

		// Var
		$this->siteName = 'main';
		$this->pageName = $pageName;
		
		// Data
		$this->contentData = $this->getXmlContentData( 'all' );

		// init Page Model
		$this->initPageModel();
	}

	public function getContentData(){
		return $this->contentData;
	}

	protected function initPageModel() {}
}

?>