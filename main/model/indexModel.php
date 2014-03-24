<?php 

include_once( 'main/model/mainModel.php' );

class indexModel extends mainModel {
	function __construct() {
		parent::__construct();
		$this->pageName = 'index';
	}
}

?>