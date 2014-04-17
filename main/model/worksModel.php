<?php 

include_once( 'main/model/mainModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class worksModel extends mainModel {
	// ===== pagination =====  //
	private $worksPerPageCount = 12;//一頁要顯示幾則
	private $currentPage = 1;
	private $dataMag;
	private $currentCategory = 'all';

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


		if($this->currentCategory != 'all'){
			// 先去抓work_tag找tag == currentCategory欄位的work_id
			$work_id_list = $this->dataMag->getDataList( array(
				'from' 	 => 'work_tag',
				'column' => 'work_id, tag',
				'target' => "tag='".$this->currentCategory."'"));
			
			// make the query statement like: "SELECT * FROM test WHERE price < 500"
			$query_target = "SELECT * FROM work WHERE id IN (";
			for($i = 0 ; $i < count($work_id_list) ; $i++){
				$query_target .= $work_id_list[$i]["work_id"];
				if ($i < count($work_id_list) - 1)
					$query_target .= ",";
			}
			$query_target .= ");";

			// 再去work 抓那些id的data
			$dataList = $this->dataMag->getDataList( array(
				'from' 	 => 'work',
				'column' => 'id, title, title_cn, img',
				//'limit' => $startIndex.','.$this->worksPerPageCount,
				'query' => $query_target));

		}else{
			// (ALL or Empty) $this->currentCategory == 'all' 
			// get data
			$dataList = $this->dataMag->getDataList( array(
				'from' => 'work',
				'column' => 'id, title, title_cn, img',
				'limit' => $startIndex.','.$this->worksPerPageCount));	//只取要的欄位				
		}
		

		return $dataList;
	}

	// =========== pagination ========= //
	public function getPageCount(){
		$dataCount = $this->dataMag->getDataCount(array(
			'from' => 'work'));
		//只要取這個tag的 or all
		return ceil($dataCount / $this->worksPerPageCount);
	}
	public function getCurrentPage(){

		return $this->currentPage;
	}
	public function setCurrentPage($pageNum){
		$this->currentPage = $pageNum;
	}
	public function setCurrentCategory($category){
		$this->currentCategory = $category;
	}
	public function getCurrentCategory(){
		return $this->currentCategory;
	}

}

?>