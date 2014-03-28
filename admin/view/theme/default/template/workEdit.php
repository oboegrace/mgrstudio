<!-- tool bar -->
<div id="content_header">
	<div class="contentArea">
		<h2 class="content_header_title">作品-編輯</h2>
		<ul class="content_header_menu">
			<li><a href="admin/works/"><i class="fa fa-arrow-left"></i>回作品列表</a></li>
		</ul>
	</div>
</div>
<div id="content">
	<div class="contentArea">
		<form action="" method="post" onsubmit="return validateForm()" name="workEditForm">
			<table cellspacing="0" cellpadding="0">	
				<tr>
					<th>Title</th>
					<td><input type="text" value="<?php if($workData) echo $workData['title'];?>" name="title"></td>
				</tr>
				<tr>
					<th>標題</th>
					<td><input type="text" value="<?php if($workData) echo $workData['title_cn'];?>" name="title_cn"></td>
				</tr>
				<tr>
					<th>Description描述</th>
					<td><textarea name="description"><?php if($workData) echo $workData['description'];?></textarea></td>
				</tr>
				<tr>
					<th><i class="fa fa-vimeo-square"/>Vimeo</th>
					<td><input type="text" value="<?php if($workData) echo $workData['vimeo_id'];?>" name="vimeo_id"></td>
				</tr>
				<tr>
					<th><i class="fa fa-youtube"/>YouTube</th>
					<td><input type="text" value="<?php if($workData) echo $workData['youtube_id'];?>" name="youtube_id"></td>
				</tr>
				<tr>
					<th>Image</th>
					<td><input type="text" value="<?php if($workData) echo $workData['img'];?>" name="img"></td>
				</tr>
				<tr>
					<th><i class="fa fa-calendar"/>Date</th>
					<td><?php if($workData) echo $workData['date'];?></td>
				</tr>
			</table>
			<?php if($workData):?>
				<input type="hidden" name="id" value="<?=$workData['id']?>"/>
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
</script>