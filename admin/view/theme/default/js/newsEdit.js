// newsEdit.js
// ======= ADJUST hight of input texarea ======= // 
var contentInput = document.getElementById('contentInput');

contentInput.style.height = 0;
contentInput.style.height = (contentInput.scrollHeight)+'px';

contentInput.onkeyup = function(event){
	// content input area's hight
	var height = this.scrollHeight; // 取得內容高度scrollHeight

	// js改外觀都要用.style來做
	this.style.height = '0px';
	this.style.height = height+'px';// 隨著input內容調整藍為高度

	console.log(height);

}

// ======= form validation & cancel ====== //
function cancel(){
	if (confirm('確定要取消編輯嗎?')){
		// yes
		// 用javascript 回上一頁
		window.location = "admin/news/";
	}
}
function validateForm(){
	var title_v = document.forms["newsForm"]["title"].value;
	title_v = title_v.trim();//把頭尾空白DELETE (incase title 是空白)

	if (title_v == null || title_v == ""){
		alert("請填標題");
		return false;
	}
}

document.getElementById('imageFile').onchange = function(){//換圖的時候執行
	// 按下確定後， do ajax post
	startAjaxUpload( this.files[0] ); // this 是function 的主人: document.getElementById('imageFile')

}

function changeImage(){
	// open file dialog 
	document.getElementById('imageFile').click();


}
function startAjaxUpload(file){

	// show loading

	// prepare datas
	var formData = new FormData();

	formData.append('ajax', 'uploadImage');// variable name & variable value
	formData.append('file', file);

	// ajax request
	// 用javascript呼叫php 回傳內容
	AjaxRequest( 'admin/newsEdit/', 'POST', formData, 
		function(backValue){
			// success
			// 上傳成功的話，在網頁上顯示圖片
			if( backValue == 'error_upload' ){
				//error message todo
			}else if ( backValue == 'error_filetype' ){
				//error message todo
			}else{
				document.getElementById('newsImage').src=backValue;
				console.log('success:'+backValue);
			}
			
		}, 
		function(backValue){
			// failed
			console.log('failed:'+backValue);
		} ) ;
}


