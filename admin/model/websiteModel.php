<?php 

include_once( 'admin/model/adminModel.php' );
include_once( 'system/XmlEditor/XmlEditorModel.php' );

class websiteModel extends adminModel {

	private $webpageName = '';
	private $pagexml = '';
	private $xmlEditorModel = null;

	public function getWebpageName() {
		return $this->webpageName;
	}
	public function getXmlEditorModel() {
		return $this->xmlEditorModel;
	}

	protected function initPageModel() {
		
		// WebpageName
		$this->webpageName = 'all'; // default
		if ( isset($_GET['page']) )
			$this->webpageName = $_GET['page'];

		// Get webpage data (xml)
		$siteName 	= 'main';
		$lang 		= 'cht';
		$this->pagexml = $siteName.'/contentData/'.$lang.'/'.$this->webpageName.'.xml';

		// Xml Editor (Model)
		$this->xmlEditorModel = new XmlEditorModel( $this->pagexml );
		switch ( $this->webpageName ) {

			case 'all':
				$this->iniXmlModel_all( $this->xmlEditorModel );
				break;
			case 'about':
				$this->iniXmlModel_about( $this->xmlEditorModel );
				break;
		}
	}

	public function iniXmlModel_all( &$xmlModel ) {

		// Link
		$xmlModel->addGroup( array(
			'name' => 'announcement',
			'title' => '首頁公告'
		));
		$xmlModel->addColumn( array(
			'group' => 'announcement',
			'name'  => 'announcement',
			'title' => '訊息',
			'note'  => '有內容時才會出現在首頁。'
		));

		// Link
		$xmlModel->addGroup( array(
			'name' => 'link',
			'title' => '連結'
		));
		$xmlModel->addColumn( array(
			'group' => 'link',
			'name'  => 'link_fb',
			'title' => 'Facebook'
		));
		$xmlModel->addColumn( array(
			'group' => 'link',
			'name'  => 'link_youtube',
			'title' => 'Youtube'
		));
		$xmlModel->addColumn( array(
			'group' => 'link',
			'name'  => 'link_vimeo',
			'title' => 'Vimeo'
		));
		$xmlModel->addColumn( array(
			'group' => 'link',
			'name'  => 'link_youku',
			'title' => '悠酷'
		));

		// Contact
		$xmlModel->addGroup( array(
			'name' => 'contactInfo',
			'title' => '聯絡資訊'
		));
		$xmlModel->addColumn( array(
			'group' => 'contactInfo',
			'name'  => 'address',
			'title' => '地址'
		));
		$xmlModel->addColumn( array(
			'group' => 'contactInfo',
			'name'  => 'tel',
			'title' => '電話'
		));
		$xmlModel->addColumn( array(
			'group' => 'contactInfo',
			'name'  => 'fax',
			'title' => '傳真'
		));
		$xmlModel->addColumn( array(
			'group' => 'contactInfo',
			'name'  => 'email',
			'title' => 'E-mail'
		));

		// Other
		$xmlModel->addGroup( array(
			'name' => 'other',
			'title' => '其他'
		));
		$xmlModel->addColumn( array(
			'group' => 'other',
			'name'  => 'copyright',
			'title' => '版權宣告'
		));
	}
	public function iniXmlModel_about( &$xmlModel ) {

		// Link
		$xmlModel->addGroup( array(
			'name' => 'content',
			'title' => '內文'
		));
		$xmlModel->addColumn( array(
			'group' => 'content',
			'name'  => 'content1',
			'title' => '段落1'
		));
		$xmlModel->addColumn( array(
			'group' => 'content',
			'name'  => 'content2',
			'title' => '段落2'
		));
	}

	// Called by Ajax
	public function saveXmlColumn() {
		$colName = $_POST['column'];
		$colData = $_POST['value'];
		$this->xmlEditorModel->saveColumn( $colName, $colData );
	}
	public function getXmlColumn() {
		$colName = $_POST['column'];
		$this->xmlEditorModel->getColumnData( $colName );
	}
}

?>