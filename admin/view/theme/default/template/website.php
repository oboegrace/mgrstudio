<div id="submenu">
	<div class="contentArea">
		<ul>
			<li><a href="admin/website/?page=all" class="<?php if($this->subPageName == 'all') echo 'current'; ?>">All</a></li>
			<li><a href="admin/website/?page=about" class="<?php if($this->subPageName == 'about') echo 'current'; ?>">about</a></li>
		</ul>
	</div>
</div>
<div id="content">
	<div class="contentArea">
		<?php $xmlEditorView->displayAll(); ?>
	</div>
</div>