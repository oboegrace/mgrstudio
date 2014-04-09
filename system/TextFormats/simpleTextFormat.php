<!-- system/TextFormats/simpleTextFormat.php -->
<?php  

include_once('system/TextFormat.php');
	class SimpleTextFormat extends TextFormat{
		protected function format($text){
			//換行
			$result = str_replace("\n",'<br/>',$text);
			//標重點[]
			$result = str_replace("[", '<strong>', $result);
			$result = str_replace("]", '</strong>', $result);
			return $result;

		}
	}

?>