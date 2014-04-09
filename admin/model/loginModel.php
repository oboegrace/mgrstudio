<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class loginModel extends adminModel {
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

	public function login(){
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));
		//== get data from front-end form
		$user 	 	 = trim($_POST['user']);
		$pw 	 	 = trim($_POST['password']);
		
		// ==== method#1
		// get member list data
		$memberList = $dataMag->getDataList( array(
			'from' => 'secure_login',
			'column' => 'user, password'));
		// mysqli_real_escape_string()
		
		for ($i = 0 ; $i < count($memberList); $i++){		
			if (strcmp($user,$memberList[$i]['user'])== 0){
				if (strcmp($pw, $memberList[$i]['password']) == 0 ){
					echo "authoticated.";
					//session_register("user");
					$_SESSION['login_user'] = $user;

				}else{
					echo "password errors";
				}
			}else{
				echo "This user name doesn't exist.";
			}
		}

		// method#2
		// get member list data
		
		$result = array();
		//$query = "SELECT userid, MD5(UNIX_TIMESTAMP() + userid + RAND(UNIX_TIMESTAMP()))         guid FROM susers WHERE email = '$email' AND password = password('$password')";
		$result = $dataMag->getDataList( array(
			'from' => 'secure_login',
			'target' => "user='".$user."'"));
		echo $result[0]['user'].$result[0]['password'];
		if(count($result) == 1){
			echo "authoticated by getDataList()";
			// session_register("user");
			// $_SESSION['login_user'] = $user;

			//header("Location: ../website");
		}else {
			echo count($result)."Your Login Name or Password is invalid";
		}
		
	}
	public function lock(){
		$user_check = $_SESSION['login_user'];
		// init data manager
		$dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));//already defined in config.php

		// get data
		$dataList = $dataMag->getDataList( array(
			'from' => 'secure_login',
			'target' => 'user='.$user_check));
		echo "target get: ".$dataList[0]['user'];	

	}
}
?>