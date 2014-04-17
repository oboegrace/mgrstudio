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
			'column' => 'id, title, title_cn, img, seq',
			'limit' => $startIndex.','.$this->worksPerPageCount));	//只取要的欄位
		// var_dump($dataList);
		// get top 3's id
		$top = $this->dataMag->getDataList( array(
			'from' => 'work',
			'column' => 'id',
			'sortBy' => 'seq:LARGE',
			'limit' => '3'
			));

		$top3 = array();
		// $top3[0]~$top3[2]
		for ($i = 0 ; $i < 3 ; $i++){
			array_push($top3, $top[$i]['id']);
		}
	
		for($i = 0 ; $i < count($dataList) ; $i++){
			if(in_array($dataList[$i]['id'],$top3)){
				$dataList[$i]['top3'] = true;
			}else
				$dataList[$i]['top3'] = false;
		}
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
		// todo: 刪掉work_tag & work_img內相關欄位

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