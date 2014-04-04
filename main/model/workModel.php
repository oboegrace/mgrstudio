<?php 

include_once( 'main/model/mainModel.php' );

class workModel extends mainModel {
	function __construct() {
		parent::__construct();
		$this->pageName = 'work';
	}
}

?>