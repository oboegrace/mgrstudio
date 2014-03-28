<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class workEditModel extends adminModel {

	function __construct() {
		parent::__construct();

		// Var
		$this->pageName = 'workEdit';
	}

	public function getWorkData() {

		// get id from url
		$id = 0 ; // 因為index 不會 = 0
		if (isset($_GET['id'])){
			$id = $_GET['id'];
		}else{	//add work
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
			'from' => 'work',
			'target' => 'id='.$id));	//只取要的欄位
		// var_dump($data[0]);
		return $data[0];
	}
	public function saveData(){
		//$_POST['title']
		//$_POST['content'];

		$id 	 	= $_POST['id'];
		$title 	 	= $_POST['title'];
		$title_cn 	= $_POST['title_cn'];
		$description = $_POST['description'];
		$vimeo_id	= $_POST['viemo_id'];
		$youtube_id	= $_POST['youtube_id'];
		$img		= $_POST['img'];
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
				'from' => 'work',
				'target' => 'id='.$id
			), 
			array(
				'title' 	=> $title,
				'title_cn' 	=> $title_cn, 
				'description' => $description,
				'vimeo_id'	=> $vimeo_id,
				'youtube_id'=> $youtube_id,
				'img'		=> $img
			)
		);
		// after saving, go back to [backend] works list
		header("Location: ../works");
	}

	public function addData(){
		
		$id 	 	= $_POST['id'];
		$title 	 	= $_POST['title'];
		$title_cn 	= $_POST['title_cn'];
		$description = $_POST['description'];
		$vimeo_id	= $_POST['viemo_id'];
		$youtube_id	= $_POST['youtube_id'];
		$img		= $_POST['img'];

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
				'to' => 'work'), 
			array(
				'title' 	=> $title,
				'title_cn' 	=> $title_cn, 
				'description' => $description,
				'vimeo_id'	=> $vimeo_id,
				'youtube_id'=> $youtube_id,
				'img'		=> $img
			)
		);
		header("Location: ../works");
	}
}

?>