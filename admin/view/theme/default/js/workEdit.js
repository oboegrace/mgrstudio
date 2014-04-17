// workEdit.js

// ======= ADJUST hight of input texarea ======= // 
var descriptionInput = document.getElementById('descriptionInput');
descriptionInput.style.height = 0 ;
descriptionInput.style.height = (descriptionInput.scrollHeight)+'px';

descriptionInput.onkeyup = function(event){
	var height = this.scrollHeight;

	this.style.height = 0;
	this.style.height = height+'px';
	console.log(height);
}

// ========= TAG ===========
function addTag(tag){
	document.getElementById("tags").value += ','+tag;

}

function cancel(){
	if (confirm('確定要取消編輯嗎?')){
		// yes
		// 用javascript 回上一頁
		window.location = "admin/works/";
	}
}
function validateForm(){
	var title_v = document.forms["workEditForm"]["title"].value;
	title_v = title_v.trim();//把頭尾空白DELETE (incase title 是空白)

	if (title_v == null || title_v == ""){
		alert("請填標題");
		return false;
	}
}

// ======= AJAX UPLOAD IMAGE PREVIEW ======= //
document.getElementById('previewInput').onchange = function(){

	// 換圖的時候&按下確定後(onchange)， do ajax post
	// 先確定有幾張
	var fileCount = this.files.length;
	console.log("file count: "+fileCount);

	for ( var i = 0 ; i < fileCount; i++ ) {

		// 產生 loading 圖片框 <div class="loadingImg"/>
		var loadingImg = document.createElement( 'div' );
		loadingImg.className = 'loadingImg';
		loadingImg.innerHTML = 'uploading...';
		document.getElementById( 'imagesContainer' ).appendChild( loadingImg );

		// 開始上傳圖片 ( 把路徑 & loading 圖片框 傳過去 )
		var file_dir = this.files[i];
		startAjaxUpload( file_dir, loadingImg );
	}

}
// Preview area onclick 呼叫 to open file dialog 
function uploadImage(){
	document.getElementById('previewInput').click();
}

function startAjaxUpload( file, loadingImg ){//loadingImg是個用來preview img 的div

	// show loading
	console.log('startAjaxUpload check file:'+file);

	// prepare datas
	var formData = new FormData();
	formData.append('ajax', 'uploadImage');// variable name & variable value
	formData.append('file', file);

	// ajax request
	// 用javascript呼叫php 回傳內容
	AjaxRequest( 'admin/workEdit/', 'POST', formData, 
		function(backValue){
			// success
			// 上傳成功的話，在網頁上顯示圖片
			if( backValue == 'error_upload' ){
				//error message todo
			} else if ( backValue == 'error_filetype' ){
				//error message todo
			} else {
				// success
				// 顯示上傳的預覽圖
				loadingImg.innerHTML = '';
				loadingImg.style.backgroundImage = 'url('+backValue+')';
			}
			
		}, 
		function(backValue){
			// failed
			loadingImg.innerHTML = 'failed';
		} ) ;
}