<?php 

include_once( 'main/model/mainModel.php' );
include_once( 'system/DataManagers/MysqlManager.php' );
include_once( 'system/TextFormats/SimpleTextFormat.php' );

class workModel extends mainModel {

	private $workId = null;
	private $dataMag;
	private $firstTag = null;

	protected function initPageModel() {
		// init data manager
		$this->dataMag = new MysqlManager( array(
			'host' => DB_HOST,
			'user' => DB_USER,
			'pass' => DB_PASS,
			'name' => DB_NAME));
	}
	public function setWorkId( $id ) {
		$this->workId = $id;
	}
	public function getWorkData() {

		// Data
		$data = $this->dataMag->getDataList( array(
			'from' => 'work',
			'target' => 'id='.$this->workId ));

		$format = new SimpleTextFormat();
		$format->setSource( $data[0]['description'] );
		$data[0]['description'] = $format->getResult();

		// Image
		$imgs = $this->dataMag->getDataList( array(
			'from' => 'work_img',
			'target' => 'work_id='.$this->workId ));
		$data[0]['imageList'] = $imgs;

		// Tags
		$tags = $this->dataMag->getDataList( array(
			'from' => 'work_tag',
			'target' => 'work_id='.$this->workId ));
		$data[0]['tagList'] = $tags;

		if ( isset($tags[0]) ) {
			$this->firstTag = $tags[0]['tag'];
		}

		return $data[0];
	}
	public function getRelatedWorks() {
		if ( $this->firstTag ) {

			$workIds = $this->dataMag->getDataList( array(
				'from' => 'work_tag',
				'target' => "tag='".$this->firstTag."'",
				'column' => 'work_id',
				'limit' => '3' ));

			$idList = array();
			foreach ( $workIds as $workId ) {
				array_push( $idList, $workId['work_id'] );
			}
			$idString = implode( ',', $idList );

			$works = $this->dataMag->getDataList( array(
				'from' => 'work',
				'target' => 'id='.$idString ));

			return $works;

		} else {
			return array();
		}

	}
}

?>