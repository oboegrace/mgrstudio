<?php 

include_once( 'admin/model/adminModel.php' );

class worksModel extends adminModel {

	function __construct() {
		parent::__construct();

		// Var
		$this->pageName = 'works';
	}
	
}

?>