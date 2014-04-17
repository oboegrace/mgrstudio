var XmlEditor = {};

XmlEditor.status = 'hidden';
XmlEditor.currColName = null;
XmlEditor.currValueElement = null;
XmlEditor.currDataBlock = null;
XmlEditor.funcPanel = null;
XmlEditor.statusPanel = null;
XmlEditor.isShiftKeyDown = false; // for send save (Shift+Enter)

XmlEditor.showEditor = function( editorName, columnName ) {

	// Close previous if it's editing
	if ( XmlEditor.status != 'hidden' && XmlEditor.status != 'editing' ) {
		console.log(XmlEditor.status);
		return;
	}
	else if ( XmlEditor.status == 'editing' ) {
		XmlEditor.hideEditor();
	}
	
	// Get Elements
	var dataCell = document.getElementById( editorName+'_'+columnName+'_cell' );
	var dataSpan = document.getElementById( editorName+'_'+columnName+'_data' );

	// Sign up
	XmlEditor.status = 'editing';
	XmlEditor.currColName = columnName;
	XmlEditor.currValueElement = dataSpan;

	// Get Data ( Ajax Request )
	var formData = new FormData();
	formData.append('ajax', 'getXmlColumn');
	formData.append("column", columnName);

	XmlEditor.ajaxRequest( 
		document.URL, 
		'POST', 
		formData, 
		function (backValue) {
			try {
				backValue = XmlEditor.backValueProcess( backValue );
				var result = JSON.parse( backValue );

				// fill in inputbox
				XmlEditor.inputBox.value = result.data;

			} catch(e) {
				XmlEditor.showStatus( 'ERROR!' );
				console.log(backValue);
			}

			// show
			var inputBlock = document.getElementById( editorName+'_'+columnName+'_inputBlock' );
			var dataBlock  = document.getElementById( editorName+'_'+columnName+'_dataBlock' );
			XmlEditor.inputPanel.style.display = 'block';
			inputBlock.appendChild( XmlEditor.inputPanel );
			inputBlock.style.display = 'block';
			dataBlock.style.display = 'none';
			XmlEditor.funcPanel.style.display = 'block';
			XmlEditor.statusPanel.style.display = 'none';
			XmlEditor.currDataBlock = dataBlock;
			XmlEditor.inputBoxAutoResize();
			XmlEditor.isShiftKeyDown = false;
		},
		function (backValue) {
			XmlEditor.showStatus( 'ERROR!' );
		});

	// inputBox fill data
	//XmlEditor.inputBox.value = dataSpan.innerHTML;
};
XmlEditor.hideEditor = function() {
	XmlEditor.inputPanel.style.display = 'none';
	XmlEditor.currDataBlock.style.display = 'block';
	XmlEditor.status = 'hidden';
};
XmlEditor.setInputToCellPos = function( cellElement ){
	// set back prev cell hight
	if ( XmlEditor.currCell )
		XmlEditor.currCell.style.height = 'auto';

	// move to last character?
};
XmlEditor.iniEditor = function() {

	// StatusPanel
	statusPanel = document.createElement('div');
	statusPanel.id = 'statusPanel';
	statusPanel.innerHTML = 'Loading..';
	XmlEditor.statusPanel = statusPanel;

	// FuncPanel
	funcPanel = document.createElement('div');
	funcPanel.id = 'funcPanel';
	XmlEditor.funcPanel = funcPanel;

	// button: save
	saveBtn = document.createElement('span');
	saveBtn.id = 'saveBtn';
	saveBtn.className = 'XmlEditor_button';
	saveBtn.innerHTML = '<i class="fa fa-check"> Save';
	saveBtn.onclick = function(event) {
		
		// Check Status
		if ( XmlEditor.status == 'editing' ) {
			XmlEditor.save();
		} else {
			// 
		}
	}

	// button: cancel
	cancelBtn = document.createElement('span');
	cancelBtn.id = 'cancelBtn';
	cancelBtn.className = 'XmlEditor_button';
	cancelBtn.innerHTML = '<i class="fa fa-times"> Cancel';
	cancelBtn.onclick = function(event) {
		XmlEditor.hideEditor();
	}

	// append
	funcPanel.appendChild( saveBtn );
	funcPanel.appendChild( cancelBtn );
	
	// Inputbox
	inputBox = document.createElement( 'textarea' );
	inputBox.value = 'aaa';
	inputBox.id = 'XmlEditor_inputBox';
	XmlEditor.inputBox = inputBox;

	// Keyup (auto increase size)
	inputBox.onkeyup = function(event) {
		// auto increase size
		XmlEditor.inputBoxAutoResize();

		if ( event.keyCode == 16 ) {
			XmlEditor.isShiftKeyDown = false;
		}
	}
	inputBox.onkeydown = function (event) {
		//console.log(event.keyCode);
		// Enter Save
		/*if ( event.keyCode == 13 ) {
			XmlEditor.save();
		}*/
		switch ( event.keyCode ) {
			case 13: // enter
				if ( XmlEditor.isShiftKeyDown )
					XmlEditor.save();
				break;
			case 16: // shift
				XmlEditor.isShiftKeyDown = true;
				break;
			case 27: // esc
				XmlEditor.hideEditor();
				break;
		}
	}
	// WindowResize
	// window.addEventListener( 'resize', function(event) {
	// 	if ( XmlEditor.currCell )
	// 		XmlEditor.setInputToCellPos( XmlEditor.currCell );
	// });

	// Input Panel (append subpanels)
	inputPanel = document.createElement( 'div' );
	inputPanel.id = ( 'XmlEditor_inputPanel' );
	inputPanel.appendChild( inputBox );
	inputPanel.appendChild( funcPanel );
	inputPanel.appendChild( statusPanel );
	XmlEditor.inputPanel = inputPanel;

	// Append;
	document.body.appendChild( inputPanel );
};
XmlEditor.inputBoxAutoResize = function() {
	XmlEditor.inputBox.style.height = '0';
	XmlEditor.inputBox.style.height = (XmlEditor.inputBox.scrollHeight + 10)+'px';
};
XmlEditor.showStatus = function( statusText ) {
	XmlEditor.funcPanel.style.display = 'none';
	XmlEditor.statusPanel.style.display = 'block';
	XmlEditor.statusPanel.innerHTML = statusText ;
};
XmlEditor.save = function() {

	// Change status
	XmlEditor.status = 'saving';
	XmlEditor.showStatus( '<img src="system/img/loading.gif"/> Saving...' );

	// Data
	var colName = XmlEditor.currColName;
	var colData = XmlEditor.inputBox.value;
	var valueString = 'ajax=saveXmlColumn&column='+colName+'&value='+colData;

	// Form Data
	var formData = new FormData();
	formData.append('ajax', 'saveXmlColumn');
	formData.append("column", colName);
	formData.append("value", colData);
	
	// Ajax Request
	XmlEditor.ajaxRequest( 
		document.URL, 
		'POST', 
		formData, 
		function (backValue) {
			try {
				backValue = XmlEditor.backValueProcess( backValue );
				var result = JSON.parse( backValue );
				XmlEditor.currValueElement.innerHTML = XmlEditor.formatText( result.data );
				XmlEditor.hideEditor();
			} catch(e) {
				XmlEditor.showStatus( 'ERROR!' );
			}
		},
		function (backValue) {
			XmlEditor.showStatus( 'ERROR!' );
		});
};
XmlEditor.ajaxRequest = function( actionPage, method, valueString, successFunc, errorFunc ) {

	// Create xmlhttp
	var xmlhttp;
	if ( window.XMLHttpRequest ) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" );
	}
	// State events
	xmlhttp.onreadystatechange = function() {
		if ( xmlhttp.readyState == 4 ) {
			if ( xmlhttp.status == 200 ) {
				if ( typeof( successFunc ) != 'undefined' )
					successFunc( xmlhttp.responseText );
			} else {
				console.log( 'AJAX: '+xmlhttp.statusText );
				if ( typeof( errorFunc ) != 'undefined' )
					errorFunc();
			}
		}
	}
	// Send
	xmlhttp.open( method, actionPage, true);
	//xmlhttp.setRequestHeader( "Content-Type", "multipart/form-data" );
	xmlhttp.send( valueString );
	console.log( valueString );
}
XmlEditor.formatText = function( text ) {
	text = text.replace(/\r\n/g, '<br/>');
	return text;
}
XmlEditor.backValueProcess = function( backValue ) {
	backValue = backValue.replace(/\n/g, '\\n');
	backValue = backValue.replace(/\r/g, '\\r');
	return backValue;
}
// Create the Edior Element When loaded
XmlEditor.iniEditor();