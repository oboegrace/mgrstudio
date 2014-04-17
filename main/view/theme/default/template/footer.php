<div id="footer">
	<div class="container">
		<div class="six columns">
			<div id="footer-logo"><img src="<?=$this->imgFolder?>footer_logo.png" id="footerlogoImg" /></div>
		</div>
		
		<div class="four columns">
			<h5>Follow Us</h5>
			<ul class="iconList">
				<li><a href="https://www.facebook.com/MGRstudio?fref=ts" target="_blank"><img src="<?=$this->imgFolder?>icon_facebook.png"/>Facebook</a></li>
				<li><a href="http://vimeo.com/user24299377/videos" target="_blank"><img src="<?=$this->imgFolder?>icon_vimeo.png"/>Vimeo</a></li>
				<li><a href="https://www.youtube.com/user/merrygoroundstudio" target="_blank"><img src="<?=$this->imgFolder?>icon_youtube.png"/>Youtube</a></li>
			</ul>
		</div>
		<div class="six columns">
			<h5>Contact</h5>
			<ul>
				<li><i class="fa fa-phone"></i><?=$c->tel;?></li>
				<li><i class="fa fa-print"></i><?=$c->fax;?></li>
				<li><a href="mailto://<?=$c->email;?>"><i class="fa fa-envelope-o"></i><?=$c->email;?></a></li>
				<li><a href="https://www.google.com.tw/maps/place/106台北市大安區復興南路一段279巷32號"><i class="fa fa-map-marker"></i><?=$c->address;?></a></li>
			</ul>
		</div>
	</div>
</div>