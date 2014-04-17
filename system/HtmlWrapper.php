<?php

class HtmlWrapper {

	protected $title = 'New Site';
	protected $baseHref = '';
	protected $cssList = array();
	protected $jsList = array();

	public function __construct() {
		
	}
	public function setTitle( $value ){
		$this->title = $value;
	}
	public function addCss( $file ){
		array_push( $this->cssList, $file );
	}
	public function addJs( $file ){
		array_push( $this->jsList, $file );
	}
	public function setBaseHref( $url ) {
		$this->baseHref = $url;
	}
	public function getHtmlStart( $headerFile = '' ){
		$r = '<html>'
			.'<head>'
			.'<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />'
			.'<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';

		if ( !empty($this->baseHref) ) {
			$r .= '<base href="'.$this->baseHref.'" />';
		}

		//$r .= file_get_contents($this->metaFile);
		$r .= '<title>'.$this->title.'</title>'
			.'<link rel="shortcut icon" href="favicon.ico" >';


		foreach ($this->cssList as $file)
			$r .= '<link type="text/css" rel="stylesheet" href="'.$file.'" />';

		$r .='</head>'
			.'<body>';

		// headerFile
		if ( $headerFile != '' ) {
			if ( is_file( $headerFile ) ) {
				$r .= file_get_contents( $headerFile );
			}
		}
		return $r;
	}
	public function getHtmlEnd( $footerFile = '' ){

		$r = '';

		// headerFile
		if ( $footerFile != '' ) {
			if ( is_file( $footerFile ) ) {
				$r .= file_get_contents( $footerFile );
			}
		}

		$r .= '</body>';

		foreach ($this->jsList as $file)
			$r .= '<script type="text/javascript" src="'.$file.'"></script>';

		$r .='</html>';
		return $r;
	}
}

?>