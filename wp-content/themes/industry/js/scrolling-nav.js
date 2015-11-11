//Changing the nav menu a attributes
jQuery(document).ready(function(){
   jQuery('li a').attr('class', 'page-scroll');
   var aTags = jQuery('li a');
   var navItems = [];
   for(var i=0; i < aTags.length; i++){
       navItems[i] = aTags[i]['innerHTML'].toLowerCase().split(' ').join('-');
   }
   console.log(navItems);
   jQuery.each(navItems, function(key, value){
      jQuery('li a').eq(key).attr('href','#' + value);
   });
   jQuery('li a').attr('class', 'page-scroll');
   
});

//jQuery to collapse the navbar on scroll
jQuery(window).scroll(function() {
    if (jQuery(".navbar").offset().top > 51) {
        jQuery(".navbar-fixed-top").addClass("top-nav-collapse");
    } else {
        jQuery(".navbar-fixed-top").removeClass("top-nav-collapse");
    }
});

//jQuery for page scrolling feature - requires jQuery Easing plugin
jQuery(function() {
    jQuery('a.page-scroll').bind('click', function(event) {
        var jQueryanchor = jQuery(this);
        console.log
        jQuery('html, body').stop().animate({
            scrollTop: jQuery(jQueryanchor.attr('href')).offset().top - jQuery('nav').height()
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
});

jQuery(window).on('scroll', function(){
                var current_scroll_position = jQuery(window).scrollTop() + jQuery(window).height(),
                    current_footer_position = jQuery('nav').offset().top,
                    header_height           = jQuery('#header').height() - jQuery('nav').height();
                    
                    if(current_footer_position >= header_height){
                        jQuery('nav').css('backgroundColor','rgba(38, 68, 104, 1)');
                        jQuery('nav').css('boxShadow','0px 2px 4px 0px rgba(0,0,0,0.50)');
                    }else if(current_footer_position < header_height){
                        jQuery('nav').css('backgroundColor','rgba(38, 68, 104, 0.7)');
                        jQuery('nav').css('boxShadow','none');
                    }
});


