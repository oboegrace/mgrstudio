<div class="row" id="row_header">
	<div class="container">
		<div class="sixteen columns"><h2 class="content_header">Works</h2></div>
	</div>
	<div class="container">
		<!-- Category Menu -->
		<div class="sixteen columns" id="categoryMenu">
			<ul>
				<li><a href="works/all"><span>All</span></a></li>
				<li><a href="works/webvideo"><span>Web Video</span></a></li>
				<li><a href="works/tvc"><span>TVC</span></a></li>
				<li><a href="works/document"><span>Documentary</span></a></li>
				<li><a href="works/mv"><span>MV</span></a></li>
				<li><a href="works/all"><span><i class="fa fa-bars"></i>　<i class="fa fa-search"></i></span></a></li>
			</ul>
		</div>
	</div>
</div>
<div class="row" id="">
	<div class="container" id="">
		<div class="sixteen columns">
			<!-- Page Title -->
			<div class="title-hr"><h5 id="currentCategory"><?=$currentCategory?></h5></div>
		</div>
		<!-- work item #1 -->
		<?php for($i = 0; $i < count($worksList) ; $i++):?>
			
			<?php if ( $i%3 == 0 ): ?>
				<div class="sixteen columns"></div>
			<?php endif; ?>

			<div class="one-third column">
				<a href="work/<?=$worksList[$i]['id']?>">
					<div class="workItem">
						<img src="main/workImg/medium/<?php if($worksList) if($worksList[$i]['img']) echo $worksList[$i]['img']; else echo "empty.jpg";?>" class="previewImg" />
						<h5><?=$worksList[$i]['title_cn']?></h5>
						<h4><?=$worksList[$i]['title']?></h4>
					</div>
				</a>
			</div>
		<?php endfor; ?>
	</div>
</div>