<div id="menu">
	<div class="contentArea">
		<ul>
		<?php foreach ( $mainMenuItems as $menuItemAttr ): ?>
			<?php if ( $pageName == $menuItemAttr['name'] ): ?>
				<li><a href="<?=$menuItemAttr['url']?>">[<?=$menuItemAttr['title']?>]</a></li>
			<?php else: ?>
				<li><a href="<?=$menuItemAttr['url']?>"><?=$menuItemAttr['title']?></a></li>
			<?php endif; ?>
		<?php endforeach; ?>
		</ul>
	</div>
</div>