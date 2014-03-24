<script>
	$("#slider").on("scroll", function() {
  		$(".slides").css({
    	"background-position": $(this).scrollLeft()/6-100+ "px 0"
  	});  
	var slider = {
  
  	el: {
    	slider: $("#slider"),
    	allSlides: $(".slide"),
    	sliderNav: $(".slider-nav"),
    	allNavButtons: $(".slider-nav > a")
  	},
  	timing: 800,
  	slideWidth: 300, // could measure this

  	init: function() {
    	// You can either manually scroll...
		this.el.slider.on("scroll", function(event) {
   			slider.moveSlidePosition(event);
		});
	    // ... or click a thing
		this.el.sliderNav.on("click", "a", function(event) {
			slider.handleNavClick(event, this);
		});
	},
	
	moveSlidePosition: function(event) {
	    // Magic Numbers
		this.el.allSlides.css({
			"background-position": $(event.target).scrollLeft()/6-100+ "px 0"
		});  
  	},

	handleNavClick: function(event, el) {
		// Don't change URL to a hash, remove if you want that
		event.preventDefault();

		// Get "1" from "#slide-1", for example
		var position = $(el).attr("href").split("-").pop();
		this.el.slider.animate({
			scrollLeft: position * this.slideWidth
		}, this.timing);

    this.changeActiveNav(el);
	},
	
	changeActiveNav: function(el) {
		// Remove active from all links
		this.el.allNavButtons.removeClass("active");
		// Add back to the one that was pressed
		$(el).addClass("active");
	}
};

slider.init();
</script>

<div id="content">
	<div id="slideshow">
		<div class="slider" id="slider">
			<div class="holder">
				<div class="slide" id="slide-0"><span class="temp">74°</span></div>
				<div class="slide" id="slide-1"><span class="temp">64°</span></div>
				<div class="slide" id="slide-2"><span class="temp">82°</span></div>
				<div class="slide" id="slide-3"><span class="temp">82°</span></div>
  			</div>
		</div>
	</div>
	<div id="highlights" >
		<div class="container">
			<div class="sixteen columns">
				<h4 id="highlighTitle">Highlight Works</h4>
			</div>
			<div class="one-third column">
				<h4>title</h4>
				<p>content</p>
			</div>
			<div class="one-third column">
				<h4>title</h4>
				<p>content</p>
			</div>
			<div class="one-third column">
				<h4>title</h4>
				<p>content</p>
			</div>

			<!-- <div>
				<h3><?=$c->welcome_title;?></h3>
				<p><?=$c->welcome_content;?></p>
			</div> -->
		</div>
	</div>
</div>
<div class="space-for-footer"></div>