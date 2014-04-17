<?php 

include_once( 'admin/view/adminView.php' );

class loginView extends adminView {

  public function display() {
    
    // Wrapper
    $wrapper = new HtmlWrapper();
    $wrapper->setTitle( SITE_NAME );
    $wrapper->setBaseHref( SETTING_BASEHREF );
    $wrapper->addCss( 'system/fonts/font-awesome.css' );
    $wrapper->addCss( 'admin/view/theme/default/css/all.css' );
    $wrapper->addCss( 'admin/view/theme/default/css/login.css' );
    $wrapper->addCss( 'admin/view/theme/default/css/bootstrap.min.css' );

    // Get Data from Model
    
    //$dataList       = $this->model->getMemberList();

    // DisplayContent
    echo $wrapper->getHtmlStart();
    require( 'admin/view/theme/default/template/login.php' );
    echo $wrapper->getHtmlEnd();
  }
}
?>