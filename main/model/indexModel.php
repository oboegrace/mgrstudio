<?php 

include_once( 'main/model/mainModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );

class indexModel extends mainModel {
	
	private $dataMag;
	private $descriptionLimit = 80;

	protected function initPageModel() {

		// init data manager
		$this->dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));
	}
	public function getHighlightList() {

		// get data
		$dataList = $this->dataMag->getDataList( array(
			'from' => 'work',
			'sortBy' => 'seq:LARGE',
			'column' => 'id, title, title_cn, img, description',
			'limit' => '3'));

		for ( $i=0; $i<count($dataList); $i++ ) {
			// description limit
			if ( mb_strlen($dataList[$i]['description'], 'utf-8') > $this->descriptionLimit )
				$dataList[$i]['description'] = mb_substr( $dataList[$i]['description'], 0, $this->descriptionLimit, "UTF-8" ).'...';
		}

		return $dataList;
	}

	public function getNewWorkList() {

		// get data
		$dataList = $this->dataMag->getDataList( array(
			'from' => 'work',
			'sortBy' => 'date:LARGE',
			'column' => 'id, title, title_cn, img',
			'limit' => '5'));

		return $dataList;
	}

}

?>	