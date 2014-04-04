<?php 

include_once( 'main/model/mainModel.php' );

class aboutModel extends mainModel {

	private $content1;
	private $content2;

	protected function initPageModel() {

		// Read Xml Data
		$tempContent = $this->getXmlContentData( 'about' );
		$this->content1 = $tempContent->content1;
		$this->content2 = $tempContent->content2;
	}
	public function getContent1() {
		return $this->content1;
	}
	public function getContent2() {
		return $this->content2;
	}
}

?>