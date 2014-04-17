<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class newsModel extends adminModel {
	// ===== pagination =====  //
	private $newsPerPageCount = 10;//一頁要顯示幾則
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

	public function getNewsList() {
		// get data (only in showing page)
		$startIndex = ($this->currentPage-1)* $this->newsPerPageCount;

		// get data
		$dataList = $this->dataMag->getDataList( array(
			'from' => 'news',
			'column' => 'id, title, date, img, content',
			'limit' => $startIndex.','.$this->newsPerPageCount));	//只取要的欄位
		// var_dump($dataList);

		return $dataList;
	}
	
	public function deleteNews(){
	/*
	$dataMag->deleteData( array(
		'from' => 'product_coffee',
		'target' => 'id=33'));
	*/
		$id 	 = $_POST['id'];
		$this->dataMag->deleteData(
			array(
				'from' => 'news',
				'target' => 'id='.$id)
		);

	}
	// =========== pagination ========= //
	public function getPageCount(){
		$dataCount = $this->dataMag->getDataCount(array(
			'from' => 'news'));

		return ceil($dataCount / $this->newsPerPageCount);
	}
	public function getCurrentPage(){

		return $this->currentPage;
	}
	public function setCurrentPage($pageNum){
		$this->currentPage = $pageNum;
	}
	
}

?>