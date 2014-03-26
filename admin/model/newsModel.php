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
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php

		// get data
		$dataList = $dataMag->getDataList( array(
			'from' => 'news',
			'column' => 'id, title, date'));	//只取要的欄位
		// var_dump($dataList);
		return $dataList;
	}
	public function deleteNews(){
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
				'from' => 'news',
				'target' => 'id='.$id)
		);

	}
	
}

?>