<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class newsEditModel extends adminModel {

	function __construct() {
		parent::__construct();

		// Var
		$this->pageName = 'newsEdit';
	}

	public function getNewsData() {

		// get id from url
		$id = 0 ; // 因為index 不會 = 0
		if (isset($_GET['id'])){
			$id = $_GET['id'];
		}else{	//add news
			return null;
		}
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php

		// get data
		$data = $dataMag->getDataList( array(
			'from' => 'news',
			'target' => 'id='.$id));	//只取要的欄位
		// var_dump($data[0]);
		return $data[0];
	}
	public function saveData(){
		//$_POST['title']
		//$_POST['content'];

		$id 	 = $_POST['id'];
		$title 	 = $_POST['title'];
		$content = $_POST['content'];
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php
		/*
	$dataMag->updateData( 
		array(
			'from' => $this->category,
			'target' => 'id='.$id ),
		array(
			'title' => $value )
	);
	*/
		$dataMag->updateData(
			array(
				'from' => 'news',
				'target' => 'id='.$id
			), 
			array(
				'title' => $title,
				'content' => $content
			)
		);

		header("Location: ../news");

	}
	public function addData(){
		$title 	 = $_POST['title'];
		$content = $_POST['content'];
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php
			/*
		$dataMag->addData( 
			array('to' => 'product_coffee'),
			array(
				'name' => 'test',
				'price' => '999'
		));
		*/
		$dataMag->addData(
			array(
				'to' => 'news'), 
			array(
				'title' => $title,
				'content' => $content
			)
		);
		header("Location: ../news");
	}
	
}

?>