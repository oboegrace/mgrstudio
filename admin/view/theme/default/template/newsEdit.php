<div id="content_header">
	<div class="contentArea">
		<h2 class="content_header_title">最新消息-編輯</h2>
		<ul class="content_header_menu">
			<li><a href="admin/news/"><i class="fa fa-arrow-left"></i>回消息列表</a></li>

		</ul>
	</div>
</div>
<div id="content">
	<div class="contentArea">
		<form action="" method="post" onsubmit="return validateForm()" name="newsForm">
			<table cellspacing="0" cellpadding="0">	
				<tr>
					<th>Title</th>
					<td><input type="text" value="<?php if($newsData) echo $newsData['title'];?>" name="title"></td>
				</tr>
				<tr>
					<th>Content</th>
					<td><textarea name="content"><?php if($newsData) echo $newsData['content'];?></textarea></td>
				</tr>
				<tr>
					<th>Date</th>
					<td><?php if($newsData) echo $newsData['date'];?></td>
				</tr>
			</table>
			<?php if($newsData):?>
				<input type="hidden" name="id" value="<?=$newsData['id']?>"/>
				<input type="hidden" name="action" value="saveData"/>
			<?php else: ?>
				<input type="hidden" name="action" value="addData"/>
			<?php endif;?>
			<input type="button" value="Cancel" onclick="cancel()"/>
			<input type="submit" value="SAVE"/>
		</form>
	</div>
</div>
<!-- javaScript -->
<script>
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
</script>