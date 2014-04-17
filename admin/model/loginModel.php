<?php 

include_once( 'system/DataManagers/MysqlManager.php' );

class loginModel {

	public function getMemberList() {
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php

		// get data
		$dataList = $dataMag->getDataList( array(
			'from' => 'secure_login',
			'column' => 'id, user, password'));	//只取要的欄位
		// var_dump($dataList);
		return $dataList;
	}

	public function login( $username, $password ){

		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));
		
		// get member list data
		$memberList = $dataMag->getDataList( array(
			'from' => 'secure_login',
			'target' => "user='".$username."'&password='".$password."'"));

		if ( $memberList ) {
			$_SESSION['mgr_user'] = $username;
			return true;
		} else {
			return false;
		}
	}
	public function checkLogin(){
		$user_check = $_SESSION['mgr_user'];

		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));

		// get data
		$dataList = $dataMag->getDataList( array(
			'from' => 'secure_login',
			'target' => "user='".$user_check."'"));

		if ( $dataList ) {
			return true;
		} else {
			return false;
		}

	}
	public function gotoLoginPage() {
		// echo "goto login page";
		header( 'location: '.DIR_ROOT.'/admin/login' );
	}
	public function logout(){
		$_SESSION['mgr_user'] = null;
		header('location: '.DIR_ROOT);
	}
}
?>