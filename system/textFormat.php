<?php 
class TextFormat{
	
	private $source = '';
	private $result = '';

	public function setSource($source){
		$this->source = $source;

	}
	
	public function getResult(){
		$this->result = $this->format($this->source);
		return $this->result;
	}
	protected function format($text){

	}
	
}
 ?>