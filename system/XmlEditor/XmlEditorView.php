<?php

class XmlEditorView {
	
	private $model = null;
	private $name = '';

	function __construct( $model, $name ) {
		$this->model = $model;
		$this->name  = $name;
	}
	public function displayAll() {
		$gAttrs = $this->model->getGroupAttrAll();
		foreach ( $gAttrs as $gName => $gAttr) {
			$this->displayByGroup( $gName );
		}
	}
	public function displayByGroup( $groupName ) {
		
		// Get Data from Model
		$groupAttr 	= $this->model->getGroupAttr( $groupName );
		$columns 	= $this->model->getColumnsByGroup( $groupName );
		$editorName = $this->name;
		$groupName 	= $groupAttr['title'];
		
		echo '<div class="XmlEditor">';
		echo '<h4>'.$groupName.'</h4>';
		echo '<table cellspacing="0" cellpadding="0">';
		foreach ( $columns as $colName => $colAttr ) {

			$colTitle 	= $colAttr['title'];
			$colData 	= $colAttr['data'];
			$dataSpanId = $editorName.'_'.$colName.'_data';
			$dataCellId = $editorName.'_'.$colName.'_cell';
			$dataBlockId = $editorName.'_'.$colName.'_dataBlock';
			$inputBlockId = $editorName.'_'.$colName.'_inputBlock';

			// data
			$colData = str_replace( "\r\n", "<br/>", $colData );

			// show
			echo '<tr>'
				.'	<th>'.$colTitle.'：</th>'
				.'	<td id="'.$dataCellId.'">'
				.'		<div id="'.$inputBlockId.'" style="display:none"></div>'
				.'		<div id="'.$dataBlockId.'">'
				.'			<span id="'.$dataSpanId.'">'.$colData.'</span>'
				.'			<span class="editBtn" onclick="XmlEditor.showEditor( \''.$editorName.'\', \''.$colName.'\' );"><i class="fa fa-pencil"></i></span>'
				.'		</div>';
			
			if ( isset($colAttr['note']) ) {
				echo '<div class="columnNote"><i class="fa fa-warning"></i> '.$colAttr['note'].'</div>';
			}

			echo '	</td>'
				.'</tr>';
		}
		echo '</table>';
		echo '</div>';
	}
}

?>