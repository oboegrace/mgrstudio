<div id="content">
	<div id="slideshow_area">
		<div id="slideshow">
			<div id="slideshow_container">
				<?php for ( $i=0; $i< count($newWorks); $i++ ): ?>
					<div class="slideshow_item" style="background-image:url(main/workImg/<?=$newWorks[$i]['img']?>);"></div>
				<?php endfor; ?>
			</div>
			<div id="slideshow_title">
				<div class="item" id="slideshow_title_content">
					<div id="slideshow_title_eng" class="eng"><?=$newWorks[0]['title'];?></div>
					<div id="slideshow_title_cht" class="cht"><?=$newWorks[0]['title_cn'];?></div>
				</div>
			</div>
		</div>
	</div>
	<div>
		<div class="container" id="slideshow_list">
			<div class="sixteen columns" id="slideshow_listcontainer">
				<div class="slideshow_listitem" id="slideshow_btn5" style="background-image:url(main/workData/0005_s.jpg)" /></div>
				<div class="slideshow_listitem" id="slideshow_btn1" style="background-image:url(main/workData/0001_s.jpg)" /></div>
				<div class="slideshow_listitem" id="slideshow_btn2" style="background-image:url(main/workData/0002_s.jpg)" /></div>
				<div class="slideshow_listitem" id="slideshow_btn3" style="background-image:url(main/workData/0003_s.jpg)" /></div>
				<div class="slideshow_listitem" id="slideshow_btn4" style="background-image:url(main/workData/0004_s.jpg)" /></div>
				<div id="slideshow_pointer"></div>
			</div>
		</div>
	</div>
	<!-- highlights -->
	<div id="highlights" >
		<div class="container">
			<div class="sixteen columns">
				<div class="title-hr-center"><h5>Hightlights</h5></div>
			</div>
			<!-- highlight item -->
			<?php for($i = 0; $i < count($highlight) ; $i++):?>
				<div class="one-third column">
					<div class="highlights-item first">
						<img src="main/workImg/medium/<?php if($highlight) if($highlight[$i]['img']) echo $highlight[$i]['img']; else echo "empty.jpg";?>" />
						<h5><?=$highlight[$i]['title_cn']?></h5>
						<h4><?=$highlight[$i]['title']?></h4>
						<p><?=$highlight[$i]['description']?></p>
					</div>
				</div>
			<?php endfor; ?>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?=$this->jsFolder?>index.js"></script>
<script type="text/javascript">
slideshow.titles = [
	<?php 
	for ( $i=0; $i< count($newWorks); $i++ ) {
		echo "'".$newWorks[$i]['title']."'";
		if ( $i < count($newWorks) - 1 ) {
			echo ",";
		}
	}
	?>
];

slideshow.ctitles = [
	<?php 
	for ( $i=0; $i< count($newWorks); $i++ ) {
		echo "'".$newWorks[$i]['title_cn']."'";
		if ( $i < count($newWorks) - 1 ) {
			echo ",";
		}
	}
	?>
];
</script>
