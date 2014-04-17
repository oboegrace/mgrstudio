<?php 

include_once( 'main/model/mainModel.php' );

class searchModel extends mainModel {
	function __construct() {
		parent::__construct();
		$this->pageName = 'search';
	}
}

?>