<div id="content_header">
	<div class="contentArea">
		<h2 class="content_header_title">作品</h2>
		<ul class="content_header_menu">
			<li><a href="admin/workEdit/"><i class="fa fa-plus"></i> 新增</a></li>
			<!-- <li><a href="#"><i class="fa fa-pencil"></i> 編輯</a></li> -->
			<li><a onclick="deleteSelection()"><i class="fa fa-trash-o"></i> 刪除選取項目</a></li>
		</ul>
	</div>
</div>
<div id="content">
	<div class="contentArea">
		<form>
			<table class="table table-hover" cellspacing="0" cellpadding="0">	
				<tr>
					<th></th>
					<th></th>
					<th>標題</th>
					<th></th>
					<th></th>
				</tr>
				<!-- php for-loop $worksList was included from worksView.php-->
				<?php for ($i = 0 ; $i < count($worksList) ; $i++): ?>
				<tr>
					<td><input type="checkbox" class="works_checkbox"></td>
					<input type="hidden" class="works_id" value="<?=$worksList[$i]['id']?>">
					
					<td><img src="main/workImg/thumb/<?php if($worksList) if($worksList[$i]['img']) echo $worksList[$i]['img']; else echo "empty.jpg";?>" class="previewImg" /></td>
					<td><?=$worksList[$i]['title']?><br><small><?=$worksList[$i]['title_cn']?></small></td>

					<td><a href="admin/workEdit/?id=<?=$worksList[$i]['id']?>"><i class="fa fa-pencil"/></a></td>
					<td><a onclick="deleteWork(<?=$worksList[$i]['id']?>);" ><i class="fa fa-trash-o"></a></td>
				</tr>
				<!-- 呼叫works.js 的deleteWorks() 產生表單＆送出 -->
				<?php endfor;?>
			</table>
		</form>
	</div>
</div>