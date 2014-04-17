<?php 

include_once( 'main/model/mainModel.php' );
include_once( 'system/TextFormats/simpleTextFormat.php' );

class aboutModel extends mainModel {

	private $content1;
	private $content2;

	protected function initPageModel() {

		// Read Xml Data
		$tempContent = $this->getXmlContentData( 'about' );

		$format = new simpleTextFormat();
		$format->setSource( $tempContent->content1 );
		$this->content1 = $format->getResult();

		$format->setSource( $tempContent->content2 );
		$this->content2 = $format->getResult();
	}
	public function getContent1() {
		return $this->content1;
	}
	public function getContent2() {
		return $this->content2;
	}
}

?>