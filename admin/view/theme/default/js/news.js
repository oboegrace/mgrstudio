function deleteNews(id){
	if (!confirm("確定要刪除此筆資料嗎?")){
		return ;
	}
	// create form
	// html: <form action="" method="post">
	var form = document.createElement('form');
	form.action = '';
	form.method = 'post';

	// create input action
	// <input type="hidden" name="action" value="deleteNews">
	var input_action = document.createElement('input');
	input_action.type = 'hidden';
	input_action.name = 'action';
	input_action.value = 'deleteNews';

	// create input id 
	// <input type="hidden" name="id" value="<?=$newsData['id']?>">
	var input_id = document.createElement('input');
	input_id.type = 'hidden';
	input_id.name = 'id';
	input_id.value = id;

	// append form to body
	form.appendChild(input_action);
	form.appendChild(input_id);
	document.body.appendChild(form);

	// submit 
	form.submit();
}

function deleteSelection(){


	// get selected id
	var input_checkbox = document.getElementsByClassName('news_checkbox');
	var input_id = document.getElementsByClassName('news_id');
	var checkedId = [];
	var id;

	for (var i = 0 ; i < input_checkbox.length; i++){
		if (input_checkbox[i].checked){
			checkedId.push(input_id[i].value);
		}
	}
	if (checkedId.length >= 1){
		if (!confirm("確定要刪除資料嗎?")){
			return ;
		}
	}else{
		alert("請先選擇欲刪除的資料");
		return;
	}

	id = checkedId.toString();

	// create form
	// html: <form action="" method="post">
	var form = document.createElement('form');
	form.action = '';
	form.method = 'post';

	// create input action
	// <input type="hidden" name="action" value="deleteNews">
	var input_action = document.createElement('input');
	input_action.type = 'hidden';
	input_action.name = 'action';
	input_action.value = 'deleteNews';

	// create input id 
	// <input type="hidden" name="id" value="<?=$newsData['id']?>">
	var input_id = document.createElement('input');
	input_id.type = 'hidden';
	input_id.name = 'id';
	input_id.value = id;

	// append form to body
	form.appendChild(input_action);
	form.appendChild(input_id);
	document.body.appendChild(form);

	// submit 
	form.submit();
}