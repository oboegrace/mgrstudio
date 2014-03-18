<?php 

include_once( 'admin/model/adminModel.php' );

class settingsModel extends adminModel {

	function __construct() {
		parent::__construct();

		// Var
		$this->pageName = 'settings';
	}
	
}

?>