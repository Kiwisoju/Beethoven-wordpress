jQuery(function($){
   $(document).ready(function(){
      // Change the hrefs of all the navigation items to link to the home page
      // todo Make it so that the nav items will link to the homepage but will also scroll down
      // to their respective sections.
      var aTags = jQuery('li a');
      aTags.splice(8);
      aTags.attr('href', '/');
   }); 
});

// Handling submitting form
jQuery(function($){
   $('#signup-form').submit(function(event){
      event.preventDefault();
      console.log('hey there you submitted a form');
      var formData = {
         'firstName'      : jQuery('input[id=firstName]').val(),
         'lastName'       : jQuery('input[id=lastName]').val(),
         'email'          : jQuery('input[id=email]').val(),
         'password'       : jQuery('input[id=pass]').val(),
         'passwordAgain'  : jQuery('input[id=passwordAgain]').val(),
         'account'        : jQuery('input[id=account]').val()
      };    
      console.log(formData);
      //Check whether the passwords match...      
      var data = {
          'action'   : 'signup',
          'signup'   : formData
      };
      
      jQuery.post('/wp-admin/admin-ajax.php', data, function(response){
         console.log(response);
         // Alert notification if username taken, passwords dont match or success.
      }, 'json');
   });
});

// Changing background colours depending on account selection
jQuery(function($){
   $('.account-btn').on('click', function(){
      
      // Set the hidden input to the value of the ID
      $('input[id=account]').val($(this).attr('id'));  
      
      if($(this).attr('id') == 'teacher'){
         $('#student').css({'backgroundColor':'#FFF',
                                      'color':'#3D689B'
         });
         
         var buttonCss = {'backgroundColor':'#694278',
                                     'border':'none',
                                      'color':'white'
         };
                           
         $('body').css({'backgroundColor':'#36213E',
                             'transition':'all .2s ease-in'
         });
         
         $('h1').css('color','#FFF');
         $('#teacher').css(buttonCss);
         $('input[type=submit]').css(buttonCss);
         
      }else if($(this).attr('id') == 'student'){
         $('#teacher').css({'backgroundColor':'#FFF',
                                      'color':'#694278'
         });
         
         var buttonCss = {'backgroundColor':'#3D689B',
                                   'border':'none',
                                    'color':'white'
         };
                           
         $('body').css({'backgroundColor':'#132336',
                             'transition':'all .2s ease-in'
         });
         $('h1').css('color','#FFF');
         $('#student').css(buttonCss);
         $('input[type=submit]').css(buttonCss);
      }
   });
});