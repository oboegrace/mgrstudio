<div id="content_header">
	<div class="contentArea">
		<h2 class="content_header_title">最新消息-編輯</h2>
		<ul class="content_header_menu">
			<li><a href="admin/news/"><i class="fa fa-arrow-left"></i> 回消息列表</a></li>

		</ul>
	</div>
</div>
<div id="content">
	<div class="contentArea">
		<br>
		<form class="form-horizontal" role="form" action="" method="post" onsubmit="return validateForm()" enctype="multipart/form-data" name="newsForm">
			<!-- title -->
			<div class="form-group editForm">
				<label for="title" class="col-sm-2 control-label">標題</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="title" value="<?php if($newsData) echo $newsData['title'];?>" name="title">
				</div>
			</div>
			<!-- Content -->
			<div class="form-group editForm">
				<label for="title" class="col-sm-2 control-label">內容</label>
				<div class="col-sm-10">
					<textarea id="contentInput" name="content" class="form-control" rows="3"><?php if($newsData) echo $newsData['content'];?></textarea>
				</div>
			</div>
			<!-- IMAGE -->
			<div class="form-group">
				<label for="imageFile" class="col-sm-2 control-label">圖片</label>
				<div class="col-sm-10">
					<input type="file" id="imageFile" name="img" style="display:none"/>
					<!-- preview image -->
					<img onclick="changeImage();" id="newsImage" src="main/newsImg/<?php if($newsData) echo $newsData['img'];?>" class="previewImg img-thumbnail" />
				</div>
			</div>
			<!-- Date -->
			<div class="form-group editForm">
				<label for="date" class="col-sm-2 control-label">時間</label>
				<div class="col-sm-10"><p><?php if($newsData) echo $newsData['date'];?></p></div>
			</div>
			<?php if($newsData):?>
				<input type="hidden" name="id" value="<?=$newsData['id']?>"/>
				<input type="hidden" name="action" value="saveData"/>
			<?php else: ?>
				<input type="hidden" name="action" value="addData"/>
			<?php endif;?>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<p>
						<button type="submit" value="SAVE" class="btn btn-primary">儲存</button>
						<button type="button" value="Cancel" class="btn btn-default" onclick="cancel()">取消</button>
					</p>
				</div>
			</div>
		</form>
	</div>
</div>
