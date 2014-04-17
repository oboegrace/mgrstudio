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
		<?php if ($errorMsg): ?>
			<p><?=$errorMsg?></p>
		<?php endif; ?>
		<br>
		<form name="workEditForm" enctype="multipart/form-data" onsubmit="return validateForm()" class="form-horizontal" role="form" action="" method="post" >
			<div class="form-group">
				<label for="englishTitle" class="col-sm-2 control-label">English Title</label>
				<div class="col-sm-10">
					<input type="text" name="title" class="form-control" id="englishTitle" value="<?php if($workData) echo $workData['title'];?>">
				</div>
			</div>
			<div class="form-group">
				<label for="cnTitle" class="col-sm-2 control-label">標題</label>
				<div class="col-sm-10">
					<input type="text" name="title_cn" class="form-control" id="cnTitle" value="<?php if($workData) echo $workData['title_cn'];?>" name="title_cn">
				</div>
			</div>
			<div class="form-group">
				<label for="description" class="col-sm-2 control-label">描述</label>
				<div class="col-sm-10">
					<textarea id="descriptionInput" name="description" class="form-control" rows="3"><?php if($workData) echo $workData['description'];?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label for="vimeoID" class="col-sm-2 control-label">Viemo ID <i class="fa fa-vimeo-square"></i></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="vimeoID" value="<?php if($workData) echo $workData['vimeo_id'];?>" name="vimeo_id">
				</div>
			</div>
			<div class="form-group">
				<label for="fbID" class="col-sm-2 control-label">YouTube ID <i class="fa fa-youtube"></i></label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="fbID" value="<?php if($workData) echo $workData['youtube_id'];?>" name="youtube_id">
				</div>
			</div>
			<!-- TAGS -->
			<div class="form-group">
				<label for="tags" class="col-sm-2 control-label">tags</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="tags" value="<?php if($workData) echo $workData['tags'];?>" name="tags">
					<ul class="tagList">
						<?php foreach($tagList as $tag): ?>
						<li onclick="addTag('<?=$tag?>');"><?=$tag?></li>
					<?php endforeach; ?>
					</ul>
				</div>
			</div>
			<!-- SEQUENCE -->
			<div class="form-group">
				<label for="seq" class="col-sm-2 control-label">順序</label>
				<div class="col-sm-10">
					<input type="number" class="form-control" id="seq" value="<?php if($workData) echo $workData['seq'];?>" name="seq">
				</div>
			</div>
			<!-- IMAGE -->
			<div class="form-group">
				<!-- left -->
				<label for="imageFile" class="col-sm-2 control-label">圖片</label>
				<!-- right -->
				<div class="col-sm-10">
					<!-- The fileinput-button span is used to style the file input field as button -->
		   			<span onclick="uploadImage();" class="btn btn-success fileinput-button" >
		        		<i class="fa fa-plus"></i><span> 新增圖檔</span>
		        		<!-- The file input field used as target for the file upload widget -->
						<input type="file" id="previewInput" name="preview_img[]" style="display:none" multiple/>
					</span>
					<!-- The container for the (preview) uploaded files -->
					<div id="imagesContainer">
						<?php foreach ( $imgList as $img ): ?>
						<!-- preview image -->
						<img src="main/workImg/<?=$img['img']?>" class="previewImg"/>
						<?php endforeach; ?>
					</div>

					<!-- preview image -->
		    		<div id="files" class="files"></div>
					<!-- The global progress bar -->
					<!-- <br>
					<div id="progress" class="progress">
						<div class="progress-bar progress-bar-success"></div>
		    		</div> -->
					<!-- <img onclick="changeImage();" id="imageUploadPreview" src="main/workImg/<?php if($workData) echo $workData['img'];?>" class="previewImg img-thumbnail" /> -->
				</div>
			</div>
			<!-- <div class="form-group">
				<label for="date">Date</label>
				<p class="help-block"><?php if($workData) echo $workData['date'];?></p>
			</div> -->
			<?php if($workData):?>
				<input type="hidden" name="id" value="<?=$workData['id']?>"/>
				<input type="hidden" name="action" value="saveData"/>
			<?php else: ?>
				<input type="hidden" name="action" value="addData"/>
			<?php endif;?>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<p>
						<button type="submit" value="SAVE" class="btn btn-success">Save</button>
						<button type="button" value="Cancel" class="btn btn-default" onclick="cancel()">Cancel</button>
					</p>
				</div>
			</div>
<!-- 			<input type="button" value="Cancel" onclick="cancel()"/>
			<input type="submit" value="SAVE"/>
 -->	</form>
	</div>
</div>
