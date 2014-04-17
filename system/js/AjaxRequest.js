function AjaxRequest( actionPage, method, valueString, successFunc, errorFunc ) {

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
}