<div id="content_header">
	<div class="contentArea">
		<h2 class="content_header_title">所有消息</h2>
		<ul class="content_header_menu">
			<li><a href="admin/newsEdit/"><i class="fa fa-plus"></i> 新增</a></li>
			<!-- <li><a href="#"><i class="fa fa-pencil"></i> 編輯</a></li> -->
			<li><a onclick="deleteSelection()"><i class="fa fa-trash-o"></i> 刪除選取項目</a></li>
		</ul>
	</div>
</div>
<div id="content">
	<div class="contentArea">
		<form>
		<table class="table table-hover dataTable" cellspacing="0" cellpadding="0">	
		<tr>
			<th></th>
			<th>最新消息</th>
			<th>Date</th>
			<th>編輯</th>
			<th>刪除</th>
		</tr>
		<!-- php for-loop -->
		<?php for ($i = 0 ; $i < count($newsList) ; $i++): ?>
		<tr>
			<td style="vertical-align:middle;"><input type="checkbox" class="news_checkbox"></td>
				<input type="hidden" class="news_id" value="<?=$newsList[$i]['id']?>">
			<td>
				<div class="media">
					<a href="admin/newsEdit/?id=<?=$newsList[$i]['id']?>" class="pull-left thumbnail">
						<img src="main/newsImg/thumb/<?php if($newsList) if($newsList[$i]['img']) echo $newsList[$i]['img']; else echo "empty.jpg";?>" class="previewImg" />
					</a>
					<div class="media-body">
						<a href="admin/newsEdit/?id=<?=$newsList[$i]['id']?>">
							<h5 class="media-heading"><?=$newsList[$i]['title']?></h5>
						</a>
						<small><?=mb_substr($newsList[$i]['content'],0,10,"utf-8")?>...</small>
					</div>
				</div>
			</td>
			<td><?=str_replace('-','/',substr($newsList[$i]['date'],0,16))?></td>
			<td><span class="iconButton"><a href="admin/newsEdit/?id=<?=$newsList[$i]['id']?>"><i class="fa fa-pencil"></a></span></td>
			<td><span class="iconButton"><a onclick="deleteNews(<?=$newsList[$i]['id']?>);"><i class="fa fa-trash-o"></a></span></td>
		</tr>
		<!-- 呼叫new.js 的deleteNews() 產生表單＆送出 -->
		<?php endfor;?>
		</table>
		</form>
		<!-- pagination -->
		<div class="twelve columns offset-by-four">
			<!-- <ul class="pageNumList"> -->
			<div class="container">
				<!-- 要如何置中? -->
			<ul class="pagination">
				<li><a>&laquo;</a></li>
				<?php for($i = 1; $i<$pageCount+1; $i++): ?>
					<?php if($i == $currentPage): ?>
						<li class="active"><a><?=($i)?><span class="sr-only">(current)</span></a></li>
					<?php else: ?>
						<li><a href="admin/news/<?=($i)?>"><?=($i)?></a></li>
					<?php endif; ?>
				<?php endfor; ?>
				<li><a>&raquo;</a></li>
			</ul>
			</div>
		</div>
	</div>
</div>
