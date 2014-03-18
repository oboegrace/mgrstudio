<?php 

include_once( 'system/Model.php' );

class SiteModel extends Model {

	protected $siteName = '';
	protected $pageName = '';
	protected $language = 'cht';

	function __construct() {
		parent::__construct();

		// Check Language
	}

	public function getSiteName() {
		return $this->siteName;
	}
	public function getPageName() {
		return $this->pageName;
	}
	public function getLanguage() {
		return $this->language;
	}
	// Get Current pageName.xml in current language folder
	public function getXmlContentData( $fileName = null, $language = null ) {
		if ( $fileName == null ) {
			$fileName = $this->pageName;
		}
		if ( $language == null ) {
			$language = $this->language;
		}
		$xmlFile = $this->siteName.'/contentData/'.$language.'/'.$fileName.'.xml';
		$xml = simplexml_load_file( $xmlFile );
		return $xml;
	}
}

?>