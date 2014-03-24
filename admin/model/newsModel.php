<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class newsModel extends adminModel {

	function __construct() {
		parent::__construct();

		// Var
		$this->pageName = 'news';
	}

	public function getNewsList() {

	}
	
}

?>