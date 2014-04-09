<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class worksModel extends adminModel {

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
			'column' => 'id, title, title_cn, img'));	//只取要的欄位
		// var_dump($dataList);
		return $dataList;
	}
	public function deleteWorks(){
	/*
	$dataMag->deleteData( array(
		'from' => 'product_coffee',
		'target' => 'id=33'));
	*/
		$id 	 = $_POST['id'];
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php
		
		$dataMag->deleteData(
			array(
				'from' => 'work',
				'target' => 'id='.$id)
		);

	}
}

?>