<div id="footer">
	<div class="container">
		<!-- contact info -->
		<!-- <div class="sixteen columns"> -->
		<div class="three columns">
			<i class="fa fa-phone"></i> <?=$c->tel;?>
		</div>
		<div class="three columns">
			<i class="fa fa-print"></i> <?=$c->fax;?>
		</div>
		<div class="four columns">
			<i class="fa fa-envelope-o"></i>
			<a class="link-mailto" href="https://mail.google.com/mail/?view=cm&amp;fs=1&amp;tf=1&amp;to=service@mgrstudio.net" target="_blank"> <?=$c->email;?></a>
		</div>
		<div class="five columns">
			<i class="fa fa-map-marker"></i> <?=$c->address;?>
		</div>

		<div class="sixteen columns">
			<div id="footer-logo">
				<img src="main/view/theme/default/images/footer_logo.png" id="footerlogoImg" />
			</div>
<<<<<<< HEAD
			<div id="footer-rights"><?=str_replace('.', '.<br>', $c->copyright);?>
			</div>
		</div>
		
=======
			<div id="footer-rights">
				<?=str_replace('.', '.<br/>', $c->copyright);?>
			</div>
		</div>
>>>>>>> FETCH_HEAD
	</div>
</div>