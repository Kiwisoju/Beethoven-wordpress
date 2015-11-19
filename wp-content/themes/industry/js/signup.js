jQuery(function($){
   $(document).ready(function(){
      // Change the hrefs of all the navigation items to link to the home page
      // todo Make it so that the nav items will link to the homepage but will also scroll down
      // to their respective sections.
      var aTags = jQuery('li a');
      aTags.splice(8);
      aTags.attr('href', '/');
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


