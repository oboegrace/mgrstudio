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
document.getElementById('imageFile').onchange = function(){
	// 換圖的時候&按下確定後， do ajax post
	startAjaxUpload( this.files[0] ); 
	// this 是function 的主人: document.getElementById('imageFile')

}
// Preview area onclick 呼叫 to open file dialog 
function changeImage(){
	document.getElementById('imageFile').click();
	// as if file input area is clicked
}


function startAjaxUpload(file){

	// show loading

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
			}else if ( backValue == 'error_filetype' ){
				//error message todo
			}else{
				document.getElementById('imageUploadPreview').src=backValue;
				console.log('success:'+backValue);
			}
			
		}, 
		function(backValue){
			// failed
			console.log('failed:'+backValue);
		} ) ;
}