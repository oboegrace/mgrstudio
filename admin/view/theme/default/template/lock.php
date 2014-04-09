<?php 
include_once( 'system/DataManagers/MysqlManager.php' );
	// public function lock(){
		$user_check = $_SESSION['login_user'];
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php

		// get data
		echo "user_check: ".$user_check."<br>";
		$dataList = $dataMag->getDataList( array(
			'from' => 'secure_login',
			// 'target' => 'user='.$user_check,
//			'target' => 'user=oboegrace@gmail.com',
			'column' => 'user'));
		echo "datalist count: ".count($dataList);
		echo "target get: ".$dataList[0]['user'];

		// check whether user_check match with the database 
		for( $i = 0 ; $i < count($dataList); $i++){
			if (strcmp($dataList[$i]['user'], $user_check) == 0 ){
				echo "authorized log-in.";
				return 0;
			}
		}
		// redirect to login page
		echo "log in fail.";
		//header("Location: login");

		if(!isset($dataList[0]['user'])){
			echo "log in fail.";
			//header("Location: ../login");
		}
	// }

 ?>