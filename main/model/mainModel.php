<?php 

include_once( 'system/SiteModel.php' );

class mainModel extends SiteModel {

	private $All;

	function __construct() {
		parent::__construct();

		// Var
		$this->siteName = 'main';
		$this->baseHref = '';
		
		// Data
		$this->xmlAll = $this->getXmlContentData( 'all' );
	}
}

?>