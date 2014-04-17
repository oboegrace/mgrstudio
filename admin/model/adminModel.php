<?php 

include_once( 'system/SiteModel.php' );
include_once( 'admin/model/loginModel.php');

class adminModel extends SiteModel {

	function __construct( $pageName ) {
		parent::__construct();

		$loginModel = new loginModel;
		if(!$loginModel->checkLogin()){
			$loginModel->gotoLoginPage();
		}
		// Var
		$this->siteName = 'admin';
		$this->pageName = $pageName;

		// init Page Model
		$this->initPageModel();
	}

	protected function initPageModel() {}

	public function logout(){
		$logoutMag = new loginModel;
		$logoutMag->logout();
	}
}

?>