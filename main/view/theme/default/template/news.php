<div class="row">
	<div class="container">
		<div class="sixteen columns"><h2 class="content_header">News</h2></div>
		<div class="four columns">
			<div class="title-hr"><h5>Years</h5></div>
			<ul>
				<li><i class="fa fa-caret-down"></i> &nbsp;2014</li>
				<li><i class="fa fa-caret-down"></i> &nbsp;2013</li>
				<li><i class="fa fa-caret-down"></i> &nbsp;2012</li>
			</ul>
		</div>
		<!-- php for loop -->
		<?php $i=0; ?>
		<?php foreach($newsItems as $item): ?>
			<?php if($i == 0 ):?>
				<div class="twelve columns news_post">
					<div class="title-hr-alpha rec"><div><h5><?=$item['date']?></h5><span></span></div></div>
			<?php else: ?>	
				<div class="twelve columns offset-by-four news_post">
					<div class="title-hr-alpha circle"><div><h5><?=$item['date']?></h5><span></span></div></div>
			<?php endif; ?>
				<?php if(trim($item['img'])): ?>
					<img src="main/newsImg/<?=$item['img']?>" alt="">
				<?php endif; ?>
					<h3><?=$item['title']?></h3>

					<p><?=$item['content']?></p>
				</div>
			<?php $i++; ?>
		<?php endforeach;?>
		<!-- pagination -->
		<div class="twelve columns offset-by-four">
			<ul class="pageNumList">
				<?php for($i = 1; $i<$pageCount+1; $i++): ?>
					<?php if($i == $currentPage): ?>
						<li><a class="current"><?=($i)?></a></li>
					<?php else: ?>
						<li><a href="news/<?=($i)?>"><?=($i)?></a></li>
					<?php endif; ?>
				<?php endfor; ?>
			</ul>
		</div>
		
	</div>
</div>