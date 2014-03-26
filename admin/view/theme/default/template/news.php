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
		<table cellspacing="0" cellpadding="0">	
		<tr>
			<th></th>
			<th>Title</th>
			<th>Date</th>	
			<th></th>
			<th></th>
		</tr>
		<!-- php for-loop -->
		<?php for ($i = 0 ; $i < count($newsList) ; $i++): ?>
		<tr>
			<td><input type="checkbox" class="news_checkbox"></td>
			<input type="hidden" class="news_id" value="<?=$newsList[$i]['id']?>">
			<td><?=$newsList[$i]['title']?></td>
			<td><?=str_replace('-','/',substr($newsList[$i]['date'],0,16))?></td>
			<td><a href="admin/newsEdit/?id=<?=$newsList[$i]['id']?>"><i class="fa fa-pencil"></a></td>
			<td><a onclick="deleteNews(<?=$newsList[$i]['id']?>);"><i class="fa fa-trash-o"></a></td>
		</tr>
		<!-- 呼叫new.js 的deleteNews() 產生表單＆送出 -->
		<?php endfor;?>
<!-- php 
<?php

//checkbox title edit delete
for ($i = 0 ; $i < count($newsList) ; $i++){
	// echo $newsList[$i]['title'].'<br>';
	echo '<tr>'.
		 '	<td><input type="checkbox" name="id" value="'.$newsList[$i]['id'].'" ></td>'.
		 '	<td>'.$newsList[$i]['title'].'</td>'.
		 '	<td><i class="fa fa-pencil"></td>'.
		 ' 	<td><i class="fa fa-trash-o"></td>'.
		 '</tr>';
}

?>
-->
		</table>
		</form>
	</div>
</div>
