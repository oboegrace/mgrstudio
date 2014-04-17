<?php

abstract class Controller {

	protected $model = null;
	protected $pathElements = null;
	
	function __construct( $model, $pathElements ) {
		$this->model = $model;
		$this->pathElements = $pathElements;
	}

}

?>