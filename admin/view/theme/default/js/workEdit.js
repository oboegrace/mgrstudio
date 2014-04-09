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