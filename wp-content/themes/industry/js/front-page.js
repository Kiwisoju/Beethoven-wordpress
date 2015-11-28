jQuery(function($){
    $(document).on('change', function(){
        switch($('option:selected').val()) {
        case 'analytics':
            $('#video-title').html('Using Analytics');
            $('#video-blurb').html('Explanation on the video and using analytics.');
            break;
        case 'lesson':
            $('#video-title').html('Creating a Lesson');
            $('#video-blurb').html('Explanation on the video and creating lessons.');
            break;
        case 'classroom':
            $('#video-title').html('Creating a Classroom');
            $('#video-blurb').html('Explanation on the video and creating a classroom.');
            break;
        case 'ear-trainer':
            $('#video-title').html('Exploring the Ear Trainer');
            $('#video-blurb').html('Explanation on the video and using the ear trainer');
            break;
        }    
    });
    
    $(document).ready(function(){
        
        (function(d, p){
            var a = new XMLHttpRequest(),
                b = d.body;
            a.open("GET", p, true);
            a.send();
            a.onload = function(){
                var c = d.createElement("div");
                c.style.display = "none";
                c.innerHTML = a.responseText;
                b.insertBefore(c, b.childNodes[0]);
            }
        })(document, "wp-content/themes/industry/images/svg/sprite.svg");
        
        glennsFormValidator.init();
   
   
       $('#contact-submit').attr('disabled', true);
       
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
       
        plyr.setup({
                    debug: 	true,
                    volume: 9,
                    title: 	"Video demo",
                    html: 	templates.controls.render({}),
                    tooltips: true,
                    captions: {
                    defaultActive: true
                },
                onSetup: function() {
                    if(!("media" in this)) {
                        return;
                    }
            
                    var player 	= this,
                        type 	= player.media.tagName.toLowerCase(),
                        toggle 	= document.querySelector("[data-toggle='fullscreen']");
                    
                    console.log("✓ Setup done for <" + type + ">");
                    
                    if(type === "video" && toggle) {
                        toggle.addEventListener("click", player.toggleFullscreen, false);
                    }
                }
        });
        
    });
});

jQuery(function($) {
  // Setup drop down menu
  $('.dropdown-toggle').dropdown();
 
  // Fix input element click problem
  $('.dropdown input, .dropdown label').click(function(e) {
    e.stopPropagation();
  });
});


//Prevent the login form from submitting default and send data to ajax processor.

// jQuery(function($){
//     jQuery( "#login-form" ).submit(function(event) {
//             event.preventDefault();
//             // var formData = {
//             //     'username'      : jQuery('input[id=username]').val(),
//             //     'password'     : jQuery('input[id=password]').val()
//             // };
            
//             // var data = {
//             //     'action': 'login',
//             //     'login'   : formData
//             // };
//             jQuery.ajax({
//                 type: 'POST',
//                 dataType: 'json',
//                 url: '/wp-admin/admin-ajax.php',
//                 data: { 
//                     'action': 'login', //calls wp_ajax_nopriv_ajaxlogin
//                     'username': jQuery('input[id=username]').val(), 
//                     'password': jQuery('input[id=password]').val(),
//                     success: function(data){
//                         console.log('this should be the message from the other file..');
//                         console.log(data);
//                         // if (data.loggedin == true){
//                         //     document.location.href = ajax_login_object.redirecturl;
//                         // }
//                     }
//                 }
//             });
            
            
            
            
//             // jQuery.post('/wp-admin/admin-ajax.php', data, function(response){
//             //     console.log(response);
//             //     var redirect = '';
                
//             //     // If there is a notification display it
//             //     if(response[0].notification){
//             //         //Display the notification somewhhere
//             //         console.log(response[0].notification);
//             //     }else{
//             //         //Redirect the user to the correct url, ie. they have logged in
//             //         switch(response[0].meta_value) {
//             //             case '10': 
//             //                 redirect = '/wp-admin';
//             //                 break;
//             //             case '5':
//             //                 redirect = '/teacher.php';
//             //                 break;
//             //             case '4':
//             //                 redirect = '/student.php';
//             //                 break;
//             //         }
//             //         window.location.href = document.location.origin + redirect;
//             //     }
//             // },'json');
//     });
// });

jQuery(function($){
    $(document).on('ready', function(){
       plyr.setup();        
    });
});
