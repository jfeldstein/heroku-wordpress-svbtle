jQuery.noConflict();
function slideFrame(thumbid, direction, type, match_height)
	{
		/* Set the new position & frame number */

		move_by = jQuery(thumbid).parent().width();
		jQuery(thumbid).children("li").animate({width: move_by+"px"});	
		
		frame_left = jQuery(thumbid).css(type).replace("px", "");
		frame = (-(frame_left/move_by));
		maxsize = (jQuery(thumbid).children("li").size()-1);
		jQuery(".dot-selected").removeClass("dot-selected");
		
		if(direction == 0)
			{
				new_frame =  Math.round((frame/1)+1);
				if(jQuery.browser.msie)
					maxsize = (maxsize-1); 
					
				if(maxsize <= frame)
					new_frame = 0;
				
			}
		else
			{
				new_frame = Math.round((frame/1)-1);
				
				if(frame == 0)
					new_frame = maxsize;
			}
			
		gotoFrame(thumbid, new_frame);
	}	
	

function gotoFrame(thumbid, frame){
	parentwidth = jQuery(thumbid).parent().width();
	new_left  = -(frame*parentwidth);
		
	jQuery(".dot-selected").removeClass("dot-selected");
	jQuery(".slider-dots").children().eq(frame).addClass("dot-selected");
				
	jQuery(thumbid).animate({"left": new_left}, {duration: 500});

	frame_left = jQuery(thumbid).css("left").replace("px", "");
	
	theli = jQuery(".slider ul.gallery-container").children("li").eq(frame);
	
	if(theli.hasClass("loading")) {
		var useheight = theli.children("a").children("img").eq(1).height();
	} else {
		var useheight = theli.children("a").children("img").eq(0).height();
	}

	if(useheight < jQuery(".controls").height())
		useheight = jQuery(".controls").height();
		
	setTimeout(function(){
		jQuery(".slider, .slider .portfolio-image").animate({height: useheight}, 250);
		jQuery.noslide = 0;
	}, 150);
};
function resize_slide(element){
	var width = jQuery(element).width();
	
	if(jQuery(element).children("ul").css("left") == undefined){
		return false;
	}
	
	var left = jQuery(element).children("ul").css("left").replace("px", "");
	var maxmove = -(jQuery(element).children("ul").children("li").size()*width);
	if(jQuery(element).children("ul").children("li").length > 1){
		var frame = jQuery(".dot-selected").index();
		jQuery(element).children("ul").children("li").animate({width: width}, 150);	
		setTimeout(function(){
			jQuery(element).children("ul").animate({left: -(frame*width)}, 700);
		}, 250);
	} else {
	 	var frame = 0;
	}
		
	theli = jQuery(".slider ul.gallery-container").children("li").eq(frame);
	
	setTimeout(function(){
		if(theli.html().toString().indexOf("<img") > -1){
			if(theli.hasClass("loading")) {
				var useheight = theli.children("a").children("img").eq(1).height();
			} else {
				var useheight = theli.children("a").children("img").eq(0).height();
			}
			jQuery(".slider, .slider .portfolio-image").animate({height: (useheight)}, 250);
		}
		jQuery.noslide = 0;
	}, 500);
}


jQuery(window).resizeend({
	onDragEnd: function(){
		jQuery.noslide = 1;
		resize_slide(".slider");
		if(jQuery(document).width() > 600){
			jQuery("#nav").show();
		}
	}
});
function clear_auto_slide(){
	jQuery("div[id^='slider-auto-']").each(function(){
		if(!isNaN(jQuery(this).text()) && jQuery(this).text() !== "0" && jQuery(this).text() !== "")
			{clearInterval(SliderInterval);}
	});
}

jQuery(document).ready(function()
	{
		
		if(jQuery.browser.msie || jQuery.browser.mozilla)
			{Screen = jQuery("html");}
		else
			{Screen = jQuery("body");}
			
		jQuery(".show-footer").live("click", function(){
			if(jQuery(this).text() == "+"){
				jQuery(this).text("-");
			} else{
				jQuery(this).text("+");
				Screen.animate({scrollTop: jQuery(document).height()});
			}
			jQuery("#footer-widget-container").slideToggle();
			return false;
		});
		jQuery("#menu-drop-button").live("click", function(){
			jQuery("#nav").slideToggle();
			jQuery(".sub-menu").css({'visibility': 'hidden'});
			jQuery(".sub-menu").css({'display': 'none'});
			return false;
		});
			
		jQuery(".fitvid, .copy").fitVids();
				
		jQuery.noslide = 0;
		var thumbid = ".slider ul.gallery-container";
		var parentwidth = jQuery(thumbid).parent().width();
		jQuery(thumbid).children("li").animate({width: parentwidth+"px"});
		jQuery(thumbid).animate({"left": 0}, {duration: 500});
		jQuery("div[id^='slider-auto-']").each(function(){
			if(!isNaN(jQuery(this).text()) && jQuery(this).text() !== "0" && jQuery(this).text() !== "")
				{
					SliderInterval = setInterval(function(){
						if(jQuery.noslide == 0)
							{
								slideFrame(thumbid, 0, "left");
							}
					}, (jQuery(this).text()*1000));
				}
		});
		
		jQuery("iframe, object").mouseover(function(){clear_auto_slide();});
		
		//Index Page slider opening
		if(jQuery(".slider").hasClass("no_display") && !jQuery(".slider").hasClass("portfolio"))
			{
				jQuery(".slider").removeClass("no_display").css({height: 0});
				var parentwidth = jQuery(".slider ul.gallery-container").parent().width();
				
				setTimeout(function(){
					jQuery(".slider ul.gallery-container").children("li").css({width: parentwidth+"px"});
					var useheight = jQuery(".slider ul.gallery-container").children("li").eq(0).children("a").children("img").height();
					jQuery(".slider, .slider .portfolio-image").animate({height: useheight}, 250);
				}, 1000);
				
			}
		
		jQuery(".controls .next").live("click", function(){
			if(jQuery.noslide == 0)
				{
					jQuery.noslide = 1;
					clear_auto_slide();
					slideFrame(thumbid, 0, "left");
				}
			return false;
		});
		
		jQuery(".controls .previous").live("click", function(){
			if(jQuery.noslide == 0)
				{
					jQuery.noslide = 1;
					clear_auto_slide();
					slideFrame(thumbid, 1, "left");
				}
			return false;
		});
		
		
		jQuery(".slider .slider-dots a").live("click", function(){
			if(jQuery.noslide == 0)
				{
					jQuery.noslide = 1;
					clear_auto_slide();
					jQuery(".dot-selected").removeClass("dot-selected");
					frame_no = jQuery(this).index();
					gotoFrame(thumbid, frame_no);
				}
			return false;
		});

		// PURCHASE BUTTONS
        jQuery(".slidingDiv").hide();
        jQuery(".show_hide").show();
 
    	jQuery('.show_hide').click(function(){
		    jQuery(".slidingDiv").slideToggle();
		    return false;
	    });
    
		
		jQuery.video_frame = 1;
		jQuery(".video-selector li a").click(function(){
			videoid = jQuery(this).attr("rel");
			
			new_videoid = jQuery(this).attr("rel").replace("#video_widget_", "");
			old_videoid = "#video_widget_"+jQuery.video_frame;
			
			jQuery(old_videoid).slideUp();
			jQuery(videoid).slideDown();
			
			jQuery(this).parent().parent().children(".selected").removeClass("selected");
			jQuery(this).parent().addClass("selected");
			
			jQuery.video_frame = new_videoid;
			return false;
		});
});