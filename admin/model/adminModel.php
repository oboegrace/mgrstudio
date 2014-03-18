<?php 

include_once( 'system/SiteModel.php' );

class adminModel extends SiteModel {

	function __construct() {
		parent::__construct();

		$this->siteName = 'admin';

	}
}

?>