<?php
include_once( 'system/TextFormat.php' );

class SimpleTextFormat extends TextFormat {
	
	protected function format( $text ) {
		// new line
		$result = str_replace("\n", '<br/>', $text);

		// strong
		$result = str_replace("[", '<strong>', $result);
		$result = str_replace("]", '</strong>', $result);

		return $result;
	}

}

?>