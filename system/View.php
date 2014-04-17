<?php

abstract class View {

	protected $model = null;

	function __construct( $model ) {
		$this->model = $model;
	}

	public function display() {

	}
}

?>