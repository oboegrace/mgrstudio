
var slideshow = {};
slideshow.currNum = 0;
slideshow.delay = 7000;
slideshow.ratio = 1920 / 700;
slideshow.ratio_list = 300 / 150;
slideshow.container;
slideshow.titles = [
	'title1',
	'title2',
	'title3',
	'title4',
	'title5'];

slideshow.ctitles = [
	'chinese title1',
	'chinese title2',
	'chinese title3',
	'chinese title4',
	'chinese title5'];

slideshow.setTitles = function(titleArray) {
	this.titles = titleArray;
}
slideshow.setCTitles = function(ctitleArray) {
	this.ctitles = ctitleArray;
}

slideshow.init = function() {

	// wrapper
	this.wrapper = document.getElementById( 'slideshow' );

	// container
	this.container = document.getElementById( 'slideshow_container' );

	// get items
	this.items = [];
	var tempItem = document.getElementsByClassName( 'slideshow_item' );
	for (var i = 0; i < tempItem.length; i++) {
		this.items.push(tempItem[i]);
	};

	// get listitems
	this.listcontainer = document.getElementById( 'slideshow_listcontainer' );
	this.listitems = document.getElementsByClassName( 'slideshow_listitem' );
	for (var i = 0; i < this.listitems.length; i++) {
		this.listitems[i].onclick = slideshow.listlitem_click(i);
	};

	// pointer
	this.pointer = document.getElementById( 'slideshow_pointer' );

	// Title
	this.title_eng = document.getElementById( 'slideshow_title_eng' );
	this.title_cht = document.getElementById( 'slideshow_title_cht' );

	// timer
	this.timer = setTimeout(this.nextItem, this.delay);

	for (var i = 1; i < this.items.length; i++) {
		this.items[i].style.opacity = '0';
	}

	slideshow.resize();
}
slideshow.listlitem_click = function(a) {
	return function() { slideshow.gotoItem(a); };
}
slideshow.nextItem = function() {
	
	slideshow.currNum++;
	if ( slideshow.currNum >= slideshow.items.length )
		slideshow.currNum = 0;

	for (var i = 0; i < slideshow.items.length; i++) {
		if ( i == slideshow.currNum ) {
			slideshow.items[i].style.opacity = '1';
		}
		else {
			slideshow.items[i].style.opacity = '0';
		}
	}
	slideshow.updatePointer();
	slideshow.updateTitle();
	window.clearTimeout( slideshow.timer )
	slideshow.timer = setTimeout(slideshow.nextItem, slideshow.delay);
}
slideshow.gotoItem = function(n) {
	
	if ( slideshow.currNum != n ) {
		slideshow.currNum = n;
		for (var i = 0; i < slideshow.items.length; i++) {
			if ( i == n ) {
				slideshow.items[i].style.opacity = '1';
			}
			else {
				slideshow.items[i].style.opacity = '0';
			}
		}
	}
	slideshow.updateTitle();
	slideshow.updatePointer();
	window.clearTimeout( slideshow.timer );
	slideshow.timer = setTimeout(slideshow.nextItem, slideshow.delay);
}
slideshow.prevItem = function() {
	/*
	slideshow.currNum--;
	if ( slideshow.currNum < 0 )
		slideshow.currNum = slideshow.items.length-1;
	
	slideshow.container.style.transition = '1.5s';
	slideshow.container.style.left = -(slideshow.width * slideshow.currNum)+'px';

	window.clearTimeout( slideshow.timer )
	slideshow.timer = setTimeout(slideshow.nextItem, slideshow.delay);
	*/
}
slideshow.keydown = function( event ) {
	//console.log( event.keyCode );
	switch( event.keyCode ) {
		case 39:
			slideshow.nextItem();
			break;
		case 37:
			slideshow.prevItem();
			break;
	}
}
slideshow.resize = function( event ) {
	var w = this.wrapper.offsetWidth;
	var h = w / slideshow.ratio ;
	// console.log('r='+w);
	if (w < 479) {
		h *= 2;
	}

	this.wrapper.style.height = h+'px';
	this.width = w;
	for (var i = 0; i < this.items.length; i++) {
		this.items[i].style.width  = w+'px';
		this.items[i].style.height = h+'px';
		this.items[i].style.left   = '0';
		//this.items[i].style.left   = w * i; 
	}
	this.container.style.transition = '0';
	//this.container.style.left = -(this.width * this.currNum)+'px';

	// list
	var lw = this.listcontainer.offsetWidth + 5;
	var margin = 6;
	var itemW = (lw / 5) - margin;
	var itemH = itemW / slideshow.ratio_list;
	var itemWM = (itemW + margin);
	//console.log( itemW );
	this.listcontainer.style.height = ( itemW / slideshow.ratio) + 'px';
	for (var i = 0; i < this.listitems.length; i++) {
		this.listitems[i].style.width  = itemW + 'px';
		this.listitems[i].style.height = itemH + 'px';
		if (w >= 767) {
			this.listitems[i].style.left  = 10 + (itemWM * i) + 'px';
		}else {
			this.listitems[i].style.left  = (itemWM * i) + 'px';
		}
	};

	// pointer
	slideshow.updatePointer();
	
}
slideshow.updateTitle = function() {
	slideshow.title_eng.innerHTML = slideshow.titles[slideshow.currNum];
	slideshow.title_cht.innerHTML = slideshow.ctitles[slideshow.currNum];
}
slideshow.updatePointer = function() {
	var lw = slideshow.listcontainer.offsetWidth + 5;
	var margin = 6;
	var itemW = (lw / 5) - margin;
	var itemH = itemW / slideshow.ratio_list;
	var itemWM = (itemW + margin);
	slideshow.pointer.style.left = slideshow.currNum * itemWM + itemW/2 + 'px';
}
slideshow.init();
window.onresize = function( event ) {
	slideshow.resize( event );
}
window.onkeydown = function(event) {
	slideshow.keydown( event )
}