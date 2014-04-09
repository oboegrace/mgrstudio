<?php 

include_once( 'main/model/mainModel.php' );
include_once( 'system/DataManagers/MySqlManager.php' );
include_once( 'system/TextFormats/simpleTextFormat.php' );

class newsModel extends mainModel {
	
	private $newsPerPageCount = 2;//一頁要顯示幾則
	private $currentPage = 1;
	private $dataMag;

	protected function initPageModel() {
		// init data manager
		$this->dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));
	}
	public function getPageCount(){
		$dataCount = $this->dataMag->getDataCount(array(
			'from' => 'news'));

		return ceil($dataCount / $this->newsPerPageCount);
	}
	public function getCurrentPage(){

		return $this->currentPage;
	}
	public function getNewsItems() {
		

		// get data
		$startIndex = ($this->currentPage-1)* $this->newsPerPageCount;
		$dataList = $this->dataMag->getDataList( array(
			'from' => 'news',
			'column' => 'id, title, date, img, content',
			'limit' => $startIndex.','. $this->newsPerPageCount));

		// formate text
		$format = new SimpleTextFormat();
		for ($i = 0 ; $i < count($dataList); $i++) {
			$format->setSource($dataList[$i]['content']);
			$dataList[$i]['content'] = $format->getResult();
			$dataList[$i]['date'] = substr($dataList[$i]['date'], 0,10);
		}

		return $dataList;
	}
	public function setCurrentPage($pageNum){
		$this->currentPage = $pageNum;
	}
}

?>