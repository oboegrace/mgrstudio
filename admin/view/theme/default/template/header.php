<div id="header">
	<div class="contentArea">
		<a href="admin/index/"><img src="<?=$this->imgFolder?>logo.gif"/></a>
		<div id="websiteBtn"><a href="index"><i class="fa fa-chevron-circle-right"></i>&nbsp;&nbsp;回網站</a></div>
	</div>
	<div id="menu">
		<div class="contentArea">
			<ul>
				<li><a href="admin/website/" class="<?php if($pageName == 'website') echo 'current';?>">網站內容</a></li>
				<li><a href="admin/news/" class="<?php if($pageName == 'news') echo 'current';?>">最新消息</a></li>
				<li><a href="admin/works/" class="<?php if($pageName == 'works') echo 'current';?>">作品管理</a></li>
				<li><a href="admin/settings/" class="<?php if($pageName == 'settings') echo 'current';?>">其他設定</a></li>
			</ul>
		</div>
	</div>
</div>