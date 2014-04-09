<?php 

include_once( 'admin/view/adminView.php' );

class loginView extends adminView {

  public function initPage( &$wrapper ){
    $wrapper-> addCss( $this->cssFolder.'bootstrap.min.css' );
    // session_start();
    // $wrapper-> addJs( $this->jsFolder.'news.js' );
  }
  public function displayContent() {
    
    // Get Data from Model
    $templateFolder = $this->getTemplateFolder();
    $dataList = $this->model->getMemberList();
    // DisplayContent
    require( $templateFolder.'login.php' );
  }
}
?>