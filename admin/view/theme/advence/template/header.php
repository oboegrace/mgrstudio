<div id="header">
	<a href="admin/index/"><h1>Blue Admin</h1></a>
	<div id="menu">
		<ul>
		<?php foreach ( $mainMenuItems as $menuItemAttr ): ?>
			<?php if ( $pageName == $menuItemAttr['name'] ): ?>
				<li><a href="<?=$menuItemAttr['url']?>" class="menu_current"><?=$menuItemAttr['title']?></a></li>
			<?php else: ?>
				<li><a href="<?=$menuItemAttr['url']?>"><?=$menuItemAttr['title']?></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ul>
	</div>
</div>