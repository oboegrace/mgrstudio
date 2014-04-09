<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class worksModel extends adminModel {
	// ===== pagination =====  //
	private $worksPerPageCount = 10;//一頁要顯示幾則
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
	public function getWorksList() {
		// get data (only in showing page)
		$startIndex = ($this->currentPage-1)* $this->worksPerPageCount;
		// get data
		$dataList = $this->dataMag->getDataList( array(
			'from' => 'work',
			'column' => 'id, title, title_cn, img',
			'limit' => $startIndex.','.$this->worksPerPageCount));	//只取要的欄位
		// var_dump($dataList);
		return $dataList;
	}
	public function deleteWorks(){
		$id 	 = $_POST['id'];
		// init data manager
	
		$this->dataMag->deleteData(
			array(
				'from' => 'work',
				'target' => 'id='.$id)
		);

	}
	// =========== pagination ========= //
	public function getPageCount(){
		$dataCount = $this->dataMag->getDataCount(array(
			'from' => 'work'));

		return ceil($dataCount / $this->worksPerPageCount);
	}
	public function getCurrentPage(){

		return $this->currentPage;
	}
	public function setCurrentPage($pageNum){
		$this->currentPage = $pageNum;
	}
}

?>