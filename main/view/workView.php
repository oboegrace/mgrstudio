<?php 

include_once( 'main/view/mainView.php' );

class workView extends mainView {

	public function initPage( &$wrapper ) {
		$wrapper->addCss( $this->cssFolder.'component/workItem.css' );
		$wrapper->addJs( $this->jsFolder.'work.js' );
	}
	public function displayContent() {
		
		// Get Data from Model
		$workData 		= $this->model->getWorkData();
		$relatedWorks 	= $this->model->getRelatedWorks();
		
		// DisplayContent
		if ( $workData )
			require( $this->templateFolder.'work.php' );
		else
			require( $this->templateFolder.'work_unfound.php' );
	}
}

?>