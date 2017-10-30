window.xs = 767;
window.md = 992;

// Get the window width
window.body_width = $("body").width();

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

initMobileFlexsliders = function(window_width){
	function setup(el){
		var id = $(el).attr('id');
		var base = $(el).data('flexslider_xs_base_html');

		if( window_width < 768 && typeof el.data('flexslider') == 'undefined' ){
			el.flexslider({
			  animation: "fade",
			  animationLoop: true,
			  directionNav: false,
			  controlNav: true,
			  slideshow: false,
			  keyboard: false,
			  after: function(slider){
			  	var current_slide = slider.currentSlide;
			  	var last_slide = slider.last;
			  	var dir = slider.direction;
			  	var new_slide = (dir == 'next' ) ? current_slide + 1 : current_slide - 1 ;
			  }
			});
		}
		else if(window_width > 767 && typeof el.data('flexslider') != 'undefined'){
			/* There is no slider.destroy() feature yet so we'll have to remove the element and recreate it */
			el.before('<div id="element_temp" class="flexslider flexslider-xs"></div>');
			el.remove();
			$('#element_temp').html(base);
			$('#element_temp').data('flexslider_xs_base_html', base); // Old object deleted from the DOM, we have to add to the data object again
			$('#element_temp').attr('id', id);
		}
	}

	/* Setup Sliders */
	setup($('#twitter-feed-list-wrap.flexslider-xs'));
};

function equalColumns(){
	if (window.body_width > window.md){
		// Init max-height value
		var maxHeight = 0;
		var columnWidth = 0;

		$("#showcase-feed article.showcase-item").each( function(){
			// If the max-height of this column's content is larger than the current maxHeight value then it is the new column height
			if ($(this).children(".post-content").outerHeight() > maxHeight){
				maxHeight = $(this).children(".post-content").outerHeight();
				maxHeight = maxHeight + $(this).children(".showcase-item-header").outerHeight();
				columnWidth = $(this).children(".post-content").outerWidth();
			}
		});

		// Assign the height for these columns
		$("article.showcase-item").outerHeight(maxHeight);
		$("article.showcase-item .meta-links").width(columnWidth);
	}
}


mobileSurroundMargin = function(){
  header_h = $("#header").innerHeight(); /* - 1; Minus the bottom border */
  surround_margin_top = $('#surround').css('margin-top');

  if(window.body_width < 767 && header_h != surround_margin_top){
    $('#surround').css('margin-top', header_h);
  }
  else if(window.body_width > 767 && surround_margin_top != 0){
    $('#surround').css('margin-top', 0 + 'px');
  }
};

function customRange(input) {
    var min = new Date();
    minimum = min.setTime( min.getTime() + 1 * 86400000 );

    return {
        minDate: min.setTime( min.getTime() + 1 * 86400000 ),
        maxDate: (input.id == "airport_parking_form_entry_date" ? $("#airport_parking_form_exit_date").datepicker("getDate") : null)
    };
}

/**
* format date for sending to car parking site
* - expects jQuery UI datepicker object, returns date as mm/dd/yyyy
*
*/
formatdate = function(input) {
    return input.getDate() + "/" + (input.getMonth() + 1) + "/" + input.getFullYear();
};

function dropdownShow(){
	// Dropdown menu functionality
	if (window.body_width < 970){
		// Hide the sub-navigation lists/dropdowns initially
		$(".dropdown-sibling").hide();
		$("#sub-content-left .sub-content-inner dl.subnav-list").hide();

		// Although show our first showcase, news and events items siblings (content)
		$(".active .dropdown-sibling").show();

		$(".subnav-dropdown-menu-anchor").each( function(){
			if($(this).hasClass("active")){
				$(this).find(".icon i.fa-caret-right").removeClass("fa-caret-right").addClass("fa-caret-down");
				$("#sub-content-left .sub-content-inner dl.subnav-list").show();
			}
		});
	}
	else
	{
		$(".subnav-dropdown-menu-anchor").find(".icon i.fa-caret-down").removeClass("fa-caret-down").addClass("fa-caret-right");
		$(".dropdown-sibling").show();
		$("#sub-content-left .sub-content-inner dl.subnav-list").show();
	}
}

function dropdownClick(event){
	// Get the target of the click event
	target = event.target;

	// Only fire if we're using the mobile or tablet layouts but exit if we are using the tablet layout and the link clicked is in a pulldown
	/*if (window.body_width > window.md || window.body_width > window.xs ){ return false; }*/
	if( $(target).hasClass("mobile-nav-top-header") === true ){ return false; }

	if($(target).hasClass("subnav-dropdown-menu-anchor")){
		event.preventDefault();

		// Slide up/down this anchor's siblings (technically the h3 wrapper's)
		$(target).parent().siblings().slideToggle(200);
		$(target).parent().siblings().toggleClass("active");

		// Toggle the active class
		$(target).toggleClass("active");

		// If this is a homepage dropdown then make the top-level container active too or not
		if ($(target).parents().eq(1).hasClass("dropdown-item")){
			$(target).parents().eq(1).toggleClass("active");
		}

		/*
		// Change the carat to the correct type
		if ($(target).hasClass("active")){
			$(target).find("i.fa-caret-right").removeClass("fa-caret-right").addClass("fa-caret-down");
		}
		else
		{
			$(target).find("i.fa-caret-down").removeClass("fa-caret-down").addClass("fa-caret-right");
		}
		*/
	}
	else if($(target).hasClass('dropdown-title')){
		event.preventDefault();

		$(target).parent().toggleClass('active');
		$(target).parent().find('.dropdown-item').slideToggle(200).toggleClass('active');

		// Toggle the active class
		$(target).toggleClass("active");
		$(target).parents().eq(1).toggleClass("active");
	}
	else{
		return false;
	}

	/* Active state indication */
	if($(target).hasClass('active')){
	  	$(target).find(".icon:not(.not-dropdown-caret) use").attr('xlink:href', '#agi-caret-down');

		/* Done with pure JS because jQuery doesn't change our viewBox attribute properly */
		for(i=0; i < target.children.length; i++){
			if(target.children[i].nodeName === 'svg' && target.children[i].className.baseVal.indexOf('dropdown-status-icon') > -1){
				target.children[i].setAttribute('viewBox', '0 0 31.947 15.974');
			}
		}
	}
	else{
	  	$(target).find(".icon:not(.not-dropdown-caret) use").attr('xlink:href', '#agi-caret-right');

		for(i=0; i < target.children.length; i++){
			if(target.children[i].nodeName === 'svg' && target.children[i].className.baseVal.indexOf('dropdown-status-icon') > -1){
				target.children[i].setAttribute('viewBox', '0 0 15.974 31.947');
			}
		}
	}
}

function pulldownClick(event){
	if (window.body_width > 767){
		// Get the target of the click event
		target = event.target;

		if($(target).hasClass('header-search-anchor')){
			if ($("#header-dropdown-search").hasClass("active")){
				$("#header-dropdown-search").removeClass("active");

				// Remove the .active class for the anchor clicked
				$(target).removeClass("active");
			}
			else{
				// Add the .active class to the anchor clicked
				$(target).addClass("active");

				// Slide the requested pulldown menu down
				$("#header-dropdown-search").addClass("active");
			}
		}
		else if ( $(target).hasClass("main-nav-anchor") === false /* || $(target).hasClass('header-search-anchor') */){

			// Get the ID of the parent li so we can get the correct pulldown menu if it exists
			id = $(target).parents().eq(0).attr("id");
			if(typeof id != 'undefined') id = id.replace("main-nav-", "");
			if(id == "header-social-links-list-search") id = id.replace("header-social-links-list-", "");

			// If a pulldown for this navigation item exists then slide it down and if there are no sub-pages just go to the top-level nav point's link
			if ($("#" + id + "-pulldown-menu").length > 0){
				// If there are no sub-pages then go to the parent element's href link
				if($("#" + id + "-pulldown-menu .pulldown-menu-inner-row").children().length < 2 && id != "search") return false;

				// Prevent the redirect straight to the parent page
				event.preventDefault();

				// If this is the currently selected pulldown menu then slide it up and unassign the .active class
				if ($("#" + id + "-pulldown-menu").hasClass("active")){
					$("#" + id + "-pulldown-menu").slideUp(200);
					$("#" + id + "-pulldown-menu").removeClass("active");

					// Remove the .active class for the anchor clicked
					$(target).removeClass("active");
				}
				// If a pulldown menu IS active AND the ID of this pulldown menu does NOT match the ID of the pulldown requested
				else if ($(".pulldown-menu").hasClass("active") && $(".pulldown-menu.active").attr("id") != ("#" + id + "-pulldown-menu")){
					// Remove the .active class on the currently active anchor
					$("#main-nav a.active").removeClass("active");
					
					// Slide any active nav items up
					$(".pulldown-menu.active").removeClass("active").slideUp(200);

					// Slide the requested pulldown menu down
					$("#" + id + "-pulldown-menu").delay(400).slideDown(200).addClass("active");
					
					// Add the .active class to the anchor clicked
					$(target).addClass("active");
				}
				else
				{
					// Add the .active class to the anchor clicked
					$(target).addClass("active");

					// Slide the requested pulldown menu down
					$("#" + id + "-pulldown-menu").slideDown(200).addClass("active");
				}

				// Set the pulldown menu wrapper to active if there is a pulldown menu active to give the wrapper a border-bottom property
				if ($(".pulldown-menu").hasClass("active")){
					$("#main-nav-pulldown-menus").addClass("active");
				}
				else
				{
					$("#main-nav-pulldown-menus").removeClass("active");
				}
			}
		}
	}
}

function mobileNavButtonClick(event){
	// Get the target of the click event
	target = event.currentTarget;

	// If the anchor or the icon within the anchor is clicked then continue
	if ($(target).attr("id") === "mobile-nav-button-anchor" || $(target).attr("id") === "header-search-anchor"){
		// Is the navigation active? Act accordingly.
		if ($(target).hasClass("active")){
			$(target).removeClass("active");

			// Fade in our semi-opaque background overlay - look at mobileNavHide() for the function that actually takes care of hiding the navigation
			$("#mobile-nav-active-overlay").removeClass("active");

			// Slide in the navigation
			$("#main-nav-pulldown-menus").css({
				"left" : "-" + 66 + "%"
			});

			$("body").removeClass("mobile-nav-active");

			$("#main-nav-pulldown-menus").hide();
		}
		else
		{
			$(target).addClass("active");

			$('.pulldown-menu-inner-subnav-row').hide();
			$("#main-nav-pulldown-menus").show();

			// Fade in our semi-opaque background overlay
			$("#mobile-nav-active-overlay").addClass("active");

			$("body").addClass("mobile-nav-active");

			// Slide out the navigation
			$("#main-nav-pulldown-menus").css({
				"left" : 0 + "%"
			});
		}
	}
}

function mobileNavItemShowClick(event){
	// Only fire if we're using the mobile layout
	if (window.body_width > window.xs){ return; }

	// Get the target of the click event
	target = event.currentTarget;

	if (window.body_width < window.xs){
		// If the target is the top-level heading of a pulldown AND that pulldown has child pages, if it doesn't then the anchor behaves as normal and refers you to the top-level page
		if ($(target).hasClass("mobile-nav-top-header") && $(target).parents().eq(2).children().length > 1){
			event.preventDefault();

			if ($(target).hasClass("active")){
				$(target).removeClass("active");

				$(target).parents().eq(1).siblings(".pulldown-menu-inner-subnav-row").slideUp(200);
			}
			else
			{
				// Toggle the active class
				$(target).toggleClass("active");

				// Toggle the sub-navigation dropdown
				$(target).parents().eq(1).siblings(".pulldown-menu-inner-subnav-row").slideDown(200);
			}

			// Change the carat to the correct type
			/*
			if ($(target).hasClass("active")){
				$(target).find(".icon i.fa-caret-right").removeClass("fa-caret-right").addClass("fa-caret-down");
			}
			else
			{
				$(target).find(".icon i.fa-caret-down").removeClass("fa-caret-down").addClass("fa-caret-right");
			}
			*/

			/* Active state indication */
			if($(target).hasClass('active')){
			  	$(target).find(".icon:not(.not-dropdown-caret) use").attr('xlink:href', '#agi-caret-down');

				/* Done with pure JS because jQuery doesn't change our viewBox attribute properly */
				for(i=0; i < target.children.length; i++){
					if(target.children[i].nodeName === 'svg' && target.children[i].className.baseVal.indexOf('dropdown-status-icon') > -1){
						target.children[i].setAttribute('viewBox', '0 0 31.947 15.974');
					}
				}
			}
			else{
			  	$(target).find(".icon:not(.not-dropdown-caret) use").attr('xlink:href', '#agi-caret-right');

				for(i=0; i < target.children.length; i++){
					if(target.children[i].nodeName === 'svg' && target.children[i].className.baseVal.indexOf('dropdown-status-icon') > -1){
						target.children[i].setAttribute('viewBox', '0 0 15.974 31.947');
					}
				}
			}
		}
	}
}

function mobileNavHide(overlay_click){
  function reset_pulldown(){
    /* Hide the pulldown and move it off the canvas so it will animate as expected and also make all top-level links inactive */
    $("#mobile-nav-active-overlay").removeClass("active");
    $("body").removeClass("mobile-nav-active");
    $("#mobile-nav-button-anchor").removeClass("active");
    $(".main-nav-anchor.active").removeClass("active");
    $("#main-nav-pulldown-menus.active").removeClass("active");
    $(".pulldown-menu.active").hide().removeClass("active");
    // $("a.mobile-nav-top-header .icon i").removeClass("fa-caret-down").addClass("fa-caret-right");

    $("a.mobile-nav-top-header").each( function(){
		$(this).find(".icon:not(.not-dropdown-caret) use").attr('xlink:href', '#agi-caret-right');
		$('a.mobile-nav-top-header').removeClass('active');

    });
  }

  if(window.body_width < 1236 /* window.xs */ && window.current_breakpoint == 'sm+' || overlay_click === true){
    reset_pulldown(); 
    $(".pulldown-menu-inner-subnav-row").hide();
    $("#main-nav-pulldown-menus").hide();
    $("#main-nav-pulldown-menus").css({ "left" : "-" + 66 + "%" });
    window.current_breakpoint = 'xs'; 
  }
  else if(window.body_width > 1236 /* window.xs */ && window.current_breakpoint == 'xs'){
    reset_pulldown();
    $(".pulldown-menu-inner-subnav-row").show();
    $("#main-nav-pulldown-menus").show();
    $("#main-nav-pulldown-menus").css({ "left" : "-" + 0 });
    window.current_breakpoint = 'sm+';
  }
}

function backToTop(){
	var scroll_value = $(document).scrollTop();          
    var viewport_size = $(window).height();

	if (scroll_value > viewport_size){
	    $("#header").addClass("sticky-head").show();
	    
	    if (scroll_value > 640){
			$("#back-to-top").fadeIn(400);
	    }
	}
	if (scroll_value < 640) {
	    $("#back-to-top").fadeOut(400);
	}
}

/* There is a mismatch with how different browsers expect co-ordinates served to document.elementFromPoint() (i.e. - relative or absolute) - this function addresses this */
elementFromPoint = function(x, y){
	var isRelative = true;
	if(!document.elementFromPoint) return null;
	
	var scrolled;
	if(scrolled = window.scrollY > 0){
		isRelative = (document.elementFromPoint(0, scrolled + window.innerHeight - 1) == null);
	}
	else if(scrolled = window.scrollX > 0){
		isRelative = (document.elementFromPoint(scrolled + window.innerWidth - 1, 0) == null);
	}
		
	if(!isRelative){
		x += window.scrollX;
		y += window.scrollY;
	}
	else{
		x = x - $(document).scrollLeft();
		y = y - $(document).scrollTop();
	}
	
	return document.elementFromPoint(x, y);
};

megaDropdownClose = function(event){
	var target = event.target;
	//console.log(target);
	if($(target).hasClass('mega-dropdown-close-button') != true) return false;
	event.preventDefault();
	
	var dropdown = $(target).parents().eq(1);
	$(dropdown).addClass('mega-dropdown-hidden').css({ 'display' : 'none' });
	window.setTimeout(
		function(){ 
			$(dropdown).removeClass('active').css({ 'display' : 'block' });
			$('#main-nav > ul').removeClass('active');
		}, 
	100);
};

$(document).ready( function(){
	/* Mouse positioning vars */
	window.mouseX, window.mouseY;

	window.body_width = $("body").width();
	window.xs = 767;
	window.md = 992;

	if(respond.mediaQueriesSupported == false) respond.update();
	if(Modernizr.svg == false){
		svg4everybody({
		    fallback: function (src, svg, use) {
		        // src: current xlink:href String, i.e. - #agi-logo
		        // svg: current SVG Element 
		        // use: current USE Element 
		        var mod = '';
		        if(use.className == 'main-nav-caret-level-2') mod = '-green';
		        if(use.className == 'white') mod = '-white';
		        if(use.className == 'flexslider') mod ='-flexslider';

		        return '/wp-content/themes/agile3/img/svg-fallbacks/' + src.replace('#', '') + mod + '.png'; // return our fallbacks from this path with this format
		    }
		});
	}

	// Pulldown navigation functionality
	$(".pulldown-menu, dl.dropdown-list > dd").hide();

	$('#twitter-feed-list-wrap.flexslider-xs').data('flexslider_xs_base_html', $('#twitter-feed-list-wrap.flexslider-xs').html());
	initMobileFlexsliders(window.body_width);

	$('.home #masthead').slick({
		  dots: true,
		  arrows:false,
		  infinite: true,
		  speed: 300,
		  slidesToShow: 1,
		  slidesToScroll: 1
	});

	$('dl#home-top-services-inner, dl#home-top-panels-inner, dl#home-personas-inner, dl#home-strategies-inner, dl#home-news-inner-list, , dl#home-blog-inner-list').slick({
		  dots: true,
		  arrows:false,
		  infinite: false,
		  speed: 300,
		  slidesToShow: 3,
		  slidesToScroll: 1,
		  responsive: [
		    {
		    	breakpoint:8000,
		    	settings: "unslick"
		    },
		    {
		    	breakpoint:767,
		    	settings:{
					dots: true,
					arrows:false,
					infinite: false,
					speed: 300,
					slidesToShow: 1,
					slidesToScroll: 1
		    	}
		    }
		  ]
	});

	$('#footer-partners-inner-container').slick({
		  dots: false,
		  arrows:false,
		  infinite: true,
		  speed: 300,
		  slidesToShow: 8,
		  slidesToScroll: 8,
		  variableWidth: true,
		  responsive: [
		  	{
		    	breakpoint:767,
		    	settings:{
					dots: false,
					arrows:false,
					infinite: false,
					speed: 300,
					slidesToShow: 1,
					slidesToScroll: 1
		    	}
		    }
		  ]
	});

	/* Cookies notice */
	if(document.getElementById("cookies-notice")){
		if(window.navigator.cookieEnabled === false || getCookie("cookies_consent") === "true"){
			document.getElementById("cookies-notice").style = "display:none;";
		}
		else if(getCookie("cookies_consent") != "true"){
			document.getElementById("cookies-notice").style = "display:block;";	
		}

		document.getElementById("cookies-notice-button").addEventListener("click", function(e) {
			e.preventDefault();
			setCookie("cookies_consent", true, 9999);
			document.getElementById("cookies-notice").style = "display:none;";
		});
	}

	$(document).mousemove(function(e) {
	  window.mouseX = e.pageX;
	  window.mouseY = e.pageY;
	});

	window.dropdown_mousein_timeout_active = false;
	window.dropdown_mouseout_timeout_active = false;

    $('#main-nav > ul > li, #main-nav > ul > li > ul > li').hover(
	    function(){
			if(window.dropdown_mouseout_timeout_active != false) return;
			var self = $(this);

	    	if($(this).hasClass('level-1')){
		    	var dropdown_second_level = $(this).children('ul.subnav-list');
		    	var dropdown_second_level_children = $(dropdown_second_level).children();

		    	/* If there's no second dropdown then we're good */
		    	if(dropdown_second_level.length < 1) return false;
		    	$(dropdown_second_level).addClass('positioning');
		    	var has_col_nav = false;

		    	$(dropdown_second_level_children).each( function(){ if($(this).hasClass('col-nav')) has_col_nav = true; })

		    	/* Column navs */
		    	if($(dropdown_second_level).hasClass('sized') === false){
			    	if(has_col_nav === true){
			    		var dropdown_second_level_w = Math.ceil( $(dropdown_second_level).width() );
				    	var dropdown_second_level_new_w = 0;
				    	var col_nav_max_h = 0;

				    	$(dropdown_second_level).find('li.col-nav').each( function(){
			    			$(this).css({ 'width' : dropdown_second_level_w });
				    		dropdown_second_level_new_w += $(this).width();
							if($(this).height() > col_nav_max_h) col_nav_max_h = $(this).height();
				    	});


				    	$(this).find('li.col-nav').height(parseInt(col_nav_max_h) + 1); // Plus one for border

				    	/* Set the width of the parent <ul> */
				    	$(dropdown_second_level).width(parseInt(dropdown_second_level_new_w) + 2).addClass('sized');
			    	}
			    	else{
				    	var minWidth = 0;

				    	/* Min-width li fix to stop items hanging off the edge of a ul that won't expand outwith its parent */
						$(dropdown_second_level_children).each(function() {
						    minWidth = $(this).parents().eq(0).width();

						    $(this).css({
						        "min-width" : minWidth + "px"
						    });
						});

						/* Set the min-width of the dropdown to that of its widest child as well */
						$(dropdown_second_level).width(parseInt(minWidth) + 2); // Plus 2 for border width
			    	}
		    	}

		    	var doc_w = $(document).width();
		    	var parent_li_offset_x1 = parseInt($(this).offset().left);
		    	var parent_li_offset_x2 = parseInt($(this).offset().left) + parseInt($(this).width()); // The right edge of our parent dropdown li
		    	var dropdown_second_level_w = parseInt($(dropdown_second_level).width());

		    	/* Position our dropdown on the side that has room */
		    	if(parent_li_offset_x1 - (dropdown_second_level_w / 2) > 0 && parent_li_offset_x2 + (dropdown_second_level_w / 2) < doc_w){
		    		var border = 2;
		    		var parent_li_w = $(this).width();

		    		$(dropdown_second_level).css({
		    			'left' : - (dropdown_second_level_w / 2) + (parent_li_w / 2) + (border / 2) + 'px'
		    		});
		    	}
		    	else if(parent_li_offset_x2 + dropdown_second_level_w > doc_w){
		    		$(dropdown_second_level).css({
		    			'right' : 0 + 'px',
		    			'left' : 'auto'
		    		});
		    	}
		    	else{
		    		$(dropdown_second_level).css({ 'left' : 0 + 'px' });
		    	}

		    	$(dropdown_second_level).removeClass('positioning').addClass('active');
	    	}
	    	else if($(this).hasClass('level-2') && $(this).hasClass('col-nav') === false){
		    	var dropdown_third_level = $(this).children('ul.subnav-list');

		    	/* If there's no second dropdown then we're good */
		    	if(dropdown_third_level.length < 1) return false;

		    	$(dropdown_third_level).addClass('positioning');

		    	var doc_w = $(document).width();
		    	var parent_li_offset_x1 = parseInt($(this).offset().left);
		    	var parent_li_offset_x2 = parseInt($(this).offset().left) + parseInt($(this).width()); // The right edge of our parent dropdown li
		    	var dropdown_third_level_w = parseInt($(dropdown_third_level).width());

		    	/* Position our dropdown on the side that has room */
		    	if(parent_li_offset_x2 + dropdown_third_level_w > doc_w){
		    		$(dropdown_third_level).css({ 'left' : '-' + dropdown_third_level_w + 'px' });
		    	}
		    	else{
		    		$(dropdown_third_level).css({ 'right' : '-' + dropdown_third_level_w + 'px' });
		    	}

		    	$(dropdown_third_level).removeClass('positioning').addClass('active');
	    	}
		},
		function(){
	  		if(window.dropdown_mouseout_timeout_active == true || dropdown_mousein_timeout_active == true) return;

			/* Wipe the styles and remove the active class */
			$(this).children('ul.subnav-list').removeClass('active');
			$(this).children('ul.subnav-list:not(.sized)').attr('style', ''); // Selector makes sure that .col-nav sizing isn't undone
		}
	);

	$("a, dl.dropdown-list dt.dropdown-title").click( function(event){
		pulldownClick(event);
		mobileNavButtonClick(event);
		mobileNavItemShowClick(event);
		dropdownClick(event);
	});

	$("button.mega-dropdown-close-button").click( function(event){
		megaDropdownClose(event);
	});

	/* News/Blog Category Filtering */
	$('#blog-listings-filters-submit, #news-listings-filters-submit, #search-listings-filters-submit, #training-listings-filters-submit, #header-dropdown-search-listings-filters-submit').hide();
	$('.search #search-pulldown-menu').addClass('active').show();

	$('form#blog-listings-filters-form input, form#news-listings-filters-form input, form#header-search-form input, form#training-listings-filters-form input, #header-dropdown-search input').change(function(){
		var id;
		console.log('foo');
		if($('form#blog-listings-filters-form input').length > 0){
			id = 'blog';
		}
		else if($('form#news-listings-filters-form input').length > 0){
			id = 'news';
		}
		else if($('form#training-listings-filters-form input').length > 0){
			id = 'training';
		}
		else if($('form#header-search-form .search-listings-category-item input').length > 0 || $('form#header-dropdown-search-form .search-listings-category-item input').length > 0){
			id = 'search';
		}

		if(id === 'search'){
			$('form#header-search-form li, form#header-dropdown-search-form li').removeClass('selected');
			$(this).parents().eq(1).addClass('selected');
		}
		else{
			$('form#' + id + '-listings-filters-form li, form#header-dropdown-search-form li').removeClass('selected');
			$(this).parents().eq(1).addClass('selected');
			$('form#' + id + '-listings-filters-form').submit();
		}
	});

	$("#mobile-nav-active-overlay").click( function(){
	    var overlay_click = true;
	    mobileNavHide(overlay_click);
    });

	// Initial load
	if (window.body_width < 1236){
		$("#main-nav-pulldown-menus").hide();
		$(".pulldown-menu-inner-subnav-row").hide();
		$("#main-nav-pulldown-menus").css({ "left" : "-" + 66 + "%" });
		// $(".subnav-dropdown-menu-anchor").find(".icon i.fa-caret-down").removeClass("fa-caret-down").addClass("fa-caret-right");


		$("a.mobile-nav-top-header").each( function(){
			$(this).find(".icon:not(.not-dropdown-caret) use").attr('xlink:href', '#agi-caret-right');

			for(i=0; i < $(this)[0].children.length; i++){
				if($(this)[0].children[i].nodeName === 'svg' && $(this)[0].children[i].className.baseVal.indexOf('dropdown-status-icon') > -1){
					$(this)[0].children[i].setAttribute('viewBox', '0 0 15.974 31.947');
				}
			}
		});
	}

	
	$(document).mousemove(function(e) {
	  window.mouseX = e.pageX;
	  window.mouseY = e.pageY;
	});
	
	window.dropdown_mousein_timeout_active = false;
	window.dropdown_mouseout_timeout_active = false;
	
	$('#main-nav > ul > li').hover(
	  function(event){
		if(window.dropdown_mouseout_timeout_active != false) return;

		window.dropdown_mousein_timeout = 
		  window.setTimeout(function(){
			var target = event.target;
			var el = elementFromPoint(window.mouseX, window.mouseY);
			var nav = $('#main-nav > ul');
			
			if($(target).hasClass('main-nav-item')){
				var dropdown = $(target).find('.mega-dropdown-menu');
			}
			else{
				var dropdown = $(target).parent('.main-nav-item').find('.mega-dropdown-menu');
			}
			var nav_item = $(dropdown).parent().attr('id');

			/* If this is the first time hovering over the navigation or we have stopped hovering over the nav items previously then add the active class for dropdowns here */
				/*
				console.log(event, 'event');
				console.log($(target).parents('.main-nav-item'), 'target.parents');
				console.log($(el), 'el');
				console.log($(el).parents('.main-nav-item'), 'el.parents');
				console.log($(el).parents('.main-nav-item').length, 'length');
				console.log($(el).hasClass('main-nav-item'), 'hasClass');
				*/

			if( 
				$(el).parents('.main-nav-item').length > 0 ||
				$(el).hasClass('main-nav-item')
			){	
				/* Hide any active mega-pulldowns */
				$('.mega-dropdown-menu.active').not(dropdown).removeClass('active');

				$(nav).addClass('active');
				if($(el).hasClass('main-nav-item')){$(el).find('.mega-dropdown-menu').addClass('active');}
				else{$(el).parents('.main-nav-item').find('.mega-dropdown-menu').addClass('active');}
			}
			
			/* For IE pre-EDGE */
			if($(target).parents('.main-nav-item').length > 0){
				$(nav).addClass('active');
				$(target).parent().find('.mega-dropdown-menu').addClass('active');
			}
			
			window.dropdown_mousein_timeout_active = false;
		}, 1000);
	  },
	  function(event){
	  	if(window.dropdown_mouseout_timeout_active == true || dropdown_mousein_timeout_active == true) return;

		window.dropdown_mouseout_timeout = 
		window.setTimeout(function(){
			window.dropdown_mouseout_timeout_active = true;

			/* var el = document.elementFromPoint(window.mouseX - window.scrollX, window.mouseY - window.scrollY); */
			var el = elementFromPoint(window.mouseX, window.mouseY);
			/*
			console.log(el, 'orig-el');
			console.log(document.elementFromPoint(window.mouseX, window.mouseY), 'el-no-offset');
			console.log(elementFromPoint(window.mouseX, window.mouseY), 'newfunc');
			*/
			var dropdown = $('.mega-dropdown-menu.active');
			var nav = $('#main-nav > ul');
			var nav_item = $(dropdown).parent().attr('id');

			/* Is the element currently hovered over not a child of our active nav item or the active dropdown? */
			if(
				$(el).parents('#' + nav_item).length == 0 ||
				$(el).attr('id') != $(dropdown).attr('id')
			){$(dropdown).removeClass('active');}
			
			/* If the item currently being hovered over on mouseout is the child of a main nav item or one itself then show it */
			if(
				$(el).parents('.main-nav-item').length > 0 ||
				$(el).hasClass('main-nav-item')
			){
				$(nav).addClass('active');
				if($(el).hasClass('main-nav-item')){$(el).find('.mega-dropdown-menu').addClass('active');}
				else{$(el).parents('.main-nav-item').find('.mega-dropdown-menu').addClass('active');}
			}
			/*
			else if($(target).parents('.main-nav-item').length > 0){
				$(nav).addClass('active');
				$(el).parent().find('.mega-dropdown-menu').addClass('active');
			}
			*/
			else{
				$(nav).removeClass('active');
				$('.mega-dropdown-menu').removeClass('active'); /*******/
				window.dropdown_mouseout_timeout = false;
			}
			
			window.dropdown_mouseout_timeout_active = false;
		}, 1000);
	  }
	);

	$(window).scroll( function(){
		backToTop();
	});

	backToTop();
	dropdownShow();

	$("#back-to-top a").click(function(){
		$("html, body").animate({ scrollTop: 0 }, 400);
		return false;
	});
});

$(window).load( function(){
	// Our news item and equal column functions
	equalColumns();
	//mobileSurroundMargin();

	/* Variable Width Flexslider Item Fix
    var flexslider_total_width = 0;
    $('#footer-partners-list-container.flexslider .slides > li').each(function() {
        flexslider_total_width+=$(this).width();
    });

   	var flexslider_avg_width = flexslider_total_width / $('#footer-partners-list-container.flexslider .slides > li').length;
	*/
/*
	$('#footer-partners-list-container.flexslider').flexslider({
        animation: "slide",
        selector: "ul.slides > li",
	    prevText: '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16.407 32" xml:space="preserve"><use xlink:href="#agi-chevron-line-l" class="flexslider"></use></svg>',
	    nextText: '<svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 16.407 32" xml:space="preserve"><use xlink:href="#agi-chevron-line-r" class="flexslider"></use></svg>',
	    controlNav: false,
	    directionNav: true,
	    slideshow: true,
	    animationLoop: true,
	    itemWidth: flexslider_avg_width,
	    itemMargin: 32,
	    minItems: 1,
	    maxItems: 50
    });
*/

	$('#footer-partners-list-container ul#footer-partners-list').slick({
		infinite: true,
		autoplay: true,
		variableWidth: true,
		draggable: false,
		slidesToShow: 6,
		slidesToScroll: 1,
		accessibility: true,
		nextArrow: '<button type="button" class="slick-next slick-arrow" title="Next Slide"><svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 19.674 32" xml:space="preserve"><use xlink:href="#agi-chevron-line-r"/></svg></button>',
		prevArrow: '<button type="button" class="slick-prev slick-arrow" title="Previous Slide"><svg class="icon svg-canvas" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 19.674 32" xml:space="preserve"><use xlink:href="#agi-chevron-line-l"/></svg></button>',
		responsive: [
			{
				breakpoint: 767,
				settings: {
					infinite: true,
					autoplay: true,
					variableWidth: false,
					slidesToShow: 1,
					slidesToScroll: 1,
					accessibility: true
				}
			}
		]
    });

	// Showcase panels matched height column fix
	$(window).resize( function(){
		// Android Chrome bug causes the resize() event to fire on scroll(), we need to check to see if the window width has actually changed
		old_width = window.body_width;
		window.body_width = $("body").width();
  		initMobileFlexsliders(window.body_width);
		//mobileSurroundMargin();

		if (window.body_width > window.md && old_width != window.body_width){
			// Hide the navigation if pulled down
			dropdownShow();
			mobileNavHide();
		}
		else
		{
			dropdownShow();

			if ($("#mobile-nav-button-anchor").hasClass("active") === false){
				mobileNavHide();
			}
		}
	});
});
