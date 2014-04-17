<?php 

include_once( 'main/view/mainView.php' );

class indexView extends mainView {
	public function initPage( &$wrapper ) {
		//$wrapper->addJs($this->jsFolder.'index.js');
		$wrapper->addCss( $this->cssFolder.'component/workItem.css' );
	}
	public function displayContent() {

		// Get Data from Model
		$highlight = $this->model->getHighlightList();
		$newWorks  = $this->model->getNewWorkList();

		// DisplayContent
		require( $this->templateFolder.'index.php' );
	}
}

?>