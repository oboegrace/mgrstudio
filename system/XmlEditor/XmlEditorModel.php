<?php
class XmlEditorModel {
	
	private $filePath = '';
	private $xml = null;
	private $groups = array();
	private $groupColumns = array();

	function __construct( $filePath ) {
		$this->filePath = $filePath;

		// get xml data
		if ( is_file( $filePath ) ) {
			$this->xml = simplexml_load_file( $filePath );
		} else {
			echo 'Xml File Not Exist: '.$filePath;
		}
	}
	public function addGroup( $attr ) {
		$name = $attr['name'];
		$this->groups[$name] = $attr;
	}

	public function addColumn( $attr ) {
		$name  = $attr['name'];
		$group = $attr['group'];
		$this->groupColumns[$group][$name] = $attr;
	}

	public function getGroupAttrAll() {
		return $this->groups;
	}

	public function getGroupAttr( $groupName ) {
		if ( isset($this->groups[$groupName]) ) {
			return $this->groups[$groupName];
		} else {
			return null;
		}
	}

	public function getColumnsByGroup( $groupName ) {
		if ( isset($this->groupColumns[$groupName]) ) {
			// fill data
			$columns = &$this->groupColumns[$groupName];
			foreach ( $columns as $colName => $colAttr ) {
				if ( isset($this->xml->$colName) ) {
					$columns[$colName]['data'] = $this->xml->$colName;
				} else {
					$columns[$colName]['data'] = null;
				}
			}
			return $this->groupColumns[$groupName];
		} else {
			return array();
		}
	}

	// Get column data (called by ajax)
	public function getColumnData( $colName ) {
		echo '{"data":"'.$this->xml->$colName.'"}';
	}

	// Save (called by ajax)
	public function saveColumn( $colName, $colData ) {
		$this->xml->$colName = $colData;
		if ( $this->xml->saveXML( $this->filePath ) ) {
			$data = str_replace( '"', '\\"', $this->xml->$colName ); // '/' <-- cause Error when prase in to JSON
			echo '{"status":1,"data":"'.$data.'"}';
			return $this->xml->$colName;
		} else {
			return false;
		}
	}
}

?>