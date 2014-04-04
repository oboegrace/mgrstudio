<?php 

include_once( 'system/SiteModel.php' );

class adminModel extends SiteModel {

	function __construct( $pageName ) {
		parent::__construct();

		// Var
		$this->siteName = 'admin';
		$this->pageName = $pageName;

		// init Page Model
		$this->initPageModel();
	}

	protected function initPageModel() {}
}

?>