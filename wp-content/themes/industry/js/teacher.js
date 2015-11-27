function initMenu() {
    jQuery('#menu ul').hide();
    jQuery('#menu ul').children('.current').parent().show();
    //jQuery('#menu ul:first').show();
    jQuery('#menu li a').click(function(){
        console.log('clicked menu item');
        var checkElement = jQuery(this).next();
        if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
            return false;
        }
        if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
            jQuery('#menu ul:visible').slideUp('normal');
            checkElement.slideDown('normal');
            return false;
        }
    });
}

jQuery(document).ready(function($){
    initMenu();
    jQuery("#menu-toggle").click(function(e) {
        e.preventDefault();
        console.log('menu toggle 1 clicked');
        jQuery("#wrapper").toggleClass("toggled");
    });
    
    glennsFormValidator.init();
   
   
   $('input[type=submit]').attr('disabled', true);
   
   $('.required').on('blur', function(){
      // Checking if there is an error class
      console.log($('.error').length);
      if($('.validated').length === $('.required').length){
         // Enabling the submit button.
         console.log('enable button');
         $('input[type=submit]').attr('disabled', false);
      }else{
         $('input[type=submit]').attr('disabled', true);
      }
      
   });
   
});

