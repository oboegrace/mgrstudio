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
		<br>
		<form class="form-horizontal" role="form" action="" method="post" onsubmit="return validateForm()" name="newsForm">
			<div clas="form-group">
				<label for="title" class="col-sm-2 control-label">標題</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" value="<?php if($newsData) echo $newsData['title'];?>" name="title">
				</div>
			</div>
			<div clas="form-group">
				<label for="title" class="col-sm-2 control-label">內容</label>
				<div class="col-sm-10">
					<textarea name="content" class="form-control" rows="3"><?php if($newsData) echo $newsData['content'];?></textarea>
				</div>
			</div>
			<div class="col-sm-2"><p class="control-label">時間</p></div>
			<div class="col-sm-10"><p><?php if($newsData) echo $newsData['date'];?></p></div>
			<?php if($newsData):?>
				<input type="hidden" name="id" value="<?=$newsData['id']?>"/>
				<input type="hidden" name="action" value="saveData"/>
			<?php else: ?>
				<input type="hidden" name="action" value="addData"/>
			<?php endif;?>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<p>
						<button type="submit" value="SAVE" class="btn btn-primary">Save</button>
						<button type="button" value="Cancel" class="btn btn-default" onclick="cancel()">Cancel</button>
					</p>
				</div>
			</div>
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