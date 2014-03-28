<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class worksModel extends adminModel {

	function __construct() {
		parent::__construct();

		// Var
		$this->pageName = 'works';
	}
	public function getWorksList() {
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));

		// get data
		$dataList = $dataMag->getDataList( array(
			'from' => 'work',
			'column' => 'id, title, title_cn'));	//只取要的欄位
		// var_dump($dataList);
		return $dataList;
	}
}

?>